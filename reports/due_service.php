<?php
        ini_set("display_errors",1);
        error_reporting(E_ALL);

        require("../login/connect.php");
        require("../login/session.php");
       // require("../dash/menu.php");


        $data['cust']     = [];
        $data['mcname']   = [];
        $data['qty']      = [];  

        if($_SERVER['REQUEST_METHOD']=="POST"){  

            $trans_dt         = $_POST['trans_dt'];
            $srv              = $_POST['srv_ctr'];
    
            $select = "select sl_no,center_name from md_service_centre
                       where sl_no  = $srv";
                   
            $result = mysqli_query($db,$select);

            $row1   = mysqli_fetch_assoc($result);

            $srvCtr = $row1['center_name'];

   
            $sql    = "select cust_cd,mc_type_id,count(mc_type_id)mc_nos from td_mc_trans 
                       where  trans_type   in ('I','S')
                       and trans_dt    <= '$trans_dt'
                       and srv_ctr      = $srv
                       and approval_status = 'U'
                       group by cust_cd,mc_type_id
                       order by cust_cd,mc_type_id";
           
            $result =  mysqli_query($db,$sql);
            
            while($row   =  mysqli_fetch_assoc($result)){

                


                for($j=0;$j<sizeof($row['cust_cd']);$j++){

                    $custCd   = $row['cust_cd'][$j];
                $mcType   = $row['mc_type_id'][$j];

                 
                    $custSql = "select cust_name from md_customers where cust_cd = $custCd";

                    $result  = mysqli_query($db,$custSql);
                    $cust_data   = mysqli_fetch_assoc($result);

                    $sql    = "select mc_id,mc_type from md_mc_type where mc_id = $mcType";
                    $result = mysqli_query($db,$sql);
                    $mc     = mysqli_fetch_assoc($result);
                    }

                array_push($data['cust']    ,$cust_data['cust_name']);
                array_push($data['mcname']  ,$row['mc_type_id']);
                array_push($data['qty']     ,$row['mc_nos']);
               } 
            }
    }    
?>

<html>
<head>
    <title>Stock Position</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/editor.dataTables.min.css">
    <link rel="stylesheet" href="../css/sb-admin.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/button.css">
    

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="../js/dataTables.editor.min.js"></script>
</head>
<script>

        $(document).ready(function () {

            $('#print').click(function () {

                printDiv();

            });

            function printDiv() {

                var divToPrint = document.getElementById('divToPrint');

                var WindowObject = window.open('', 'Print-Window');
                WindowObject.document.open();
                WindowObject.document.writeln('<!DOCTYPE html>');
                WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


                WindowObject.document.writeln('@media print { .center { text-align: center;}' +
                    '                                         .inline { display: inline; }' +
                    '                                         .underline { text-decoration: underline; }' +
                    '                                         .left { margin-left: 315px;} ' +
                    '                                         .right { margin-right: 375px; display: inline; }' +
                    '                                          table { border-collapse: collapse; }' +
                    '                                          th, td { border: 1px solid black; border-collapse: collapse; padding: 10px;}' +
                    '                                           th, td { }' +
                    '                                         .border { border: 1px solid black; } ' +
                    '                                         .bottom { bottom: 5px; width: 100%; position: fixed ' +
                    '                                       ' +
                    '                                   } } </style>');
                // WindowObject.document.writeln('<style type="text/css">@media print{p { color: blue; }}');
                WindowObject.document.writeln('</head><body onload="window.print()">');
                WindowObject.document.writeln(divToPrint.innerHTML);
                WindowObject.document.writeln('</body></html>');
                WindowObject.document.close();
                setTimeout(function () {
                    WindowObject.close();
                }, 10);

            }

        });

    </script>
<body>
<div style="min-height: 500px;">
<div class="content-wrapper">
    <div class="container-fluid">
        <!--<h2 style="margin-left:60px;text-align:center"><?php echo $item_desc.' Stock Position As On : '.date('d/m/Y',strtotime($trans_dt)); ?></h2>-->
        <hr class="new">
        <div class="card mb-3">
            <div class="card-header" style="margin-left:60px;">

                 <i class="fa fa-home btn btn-primary" >
                    <span><?php echo "Service Center : ".$srvCtr; ?></span>
                </i>
                
                
            </div>
            <hr class="new">
                <div class="card-body">
                    <div class="w3-responsive" style="margin-left:60px;" id="divToPrint">
                        <table id="dta" class="w3-table-all" width="50%">
                            <!--<caption><h3><u><?php echo $item_desc.' Stock Position As On : '.date('d/m/Y',strtotime($trans_dt)).
                                                ' for '.$srvCtr;
                                     ?></u></h3>
                            </caption>-->
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>Sl.No.</th>
                                    <th>Customer</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                    for($i=0;$i<sizeof($data['cust']);$i++){?>
                                        <tr>
                                            <td><?php echo $i+1;?></td>
                                            <td><?php echo $data['cust'][$i]; ?></td>
                                            <td><?php echo $data['mcname'][$i]; ?></td>
                                            <td><?php echo $data['qty'][$i]; ?></td>
                                        </tr>    
                                 <?php
                                    }         
                                 ?>      
                            </tbody>    
                        </table>
                    </div>
                
                    <button class="btn btn-primary" id="print" type="button" style="margin-left:50px;">Print</button>
                </div>
        </div>
    </div>
</div>
</div>
</body>
<?php
        require("../dash/footer.php");
?>

<!--<script>
    $(document).ready(function() {
        $('#dta').DataTable();
    } );
</script>-->