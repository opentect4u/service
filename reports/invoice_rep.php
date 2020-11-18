<?php
        ini_set("display_errors",1);
        error_reporting(E_ALL);

        require("../login/connect.php");
        require("../login/session.php");
        require("../dash/menu.php");

        $data['inv_no']         = [];
        $data['sale_dt']        = [];
        $data['cust_name']      = [];
        $data['mc_name']        = [];
        $data['mc_ver']         = [];
        $data['qty']            = [];
        

        if($_SERVER['REQUEST_METHOD']=="POST"){  

            $from_dt         = $_POST['from_dt'];
            $to_dt           = $_POST['to_dt'];
            
            $sql    = "SELECT bill_no,
                              cust_cd,
                              arrival_dt,
                              mc_type,
                              mc_version,
                              abs(mc_qty)mc_qty
                       from   td_device_trans 
                       where  arrival_dt between '$from_dt' and '$to_dt'
                       and    trans_type = 'S'
                       order by arrival_dt,bill_no";
           
            $result =  mysqli_query($db,$sql);

            while($row   =  mysqli_fetch_assoc($result)){

                $custCd     = $row['cust_cd'];
                $custSql    = "select cust_cd,cust_name from md_customers where cust_cd = $custCd";
                $custResult = mysqli_query($db,$custSql);
                $custRow    = mysqli_fetch_assoc($custResult);

                $mcId       = $row['mc_type'];
                $mcSql      = "select mc_id,mc_type from md_mc_type where mc_id = $mcId";
                $mcResult   = mysqli_query($db,$mcSql);
                $mcRow      = mysqli_fetch_assoc($mcResult);

                $verId      = $row['mc_version'];
                $verSql     = "select sl_no,version_name from md_version where sl_no = $verId";
                $verResult  = mysqli_query($db,$verSql);
                $verRow     = mysqli_fetch_assoc($verResult);

                
                array_push($data['inv_no']      ,$row['bill_no']);
                array_push($data['sale_dt']     ,$row['arrival_dt']);
                array_push($data['cust_name']   ,$custRow['cust_name']);
                array_push($data['mc_name']     ,$mcRow['mc_type']);
                array_push($data['mc_ver']      ,$verRow['version_name']);
                array_push($data['qty']         ,$row['mc_qty']);
               }
        }    
?>

<html>
<head>
    <title>Date Wise Invoice</title>
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
        <h2 style="margin-left:60px;text-align:center"><?php echo 'Invoice Raised Between : '.date('d/m/Y',strtotime($from_dt)).' To '.date('d/m/Y',strtotime($to_dt)); ?></h2>
        <hr class="new">
        <div class="card mb-3">
            <!--<div class="card-header" style="margin-left:60px;">

                 <i class="fa fa-asterisk btn btn-primary" >
                    <span><?php echo "Service Center : ".$srvCtr; ?></span>
                </i>
                
                
            </div>-->
            <hr class="new">
                <div class="card-body">
                    <div class="w3-responsive" style="margin-left:60px;" id="divToPrint">
                        <table id="dta" class="w3-table-all" width="50%">
                            <caption><h3><u><?php echo 'Invoice Raised Between : '.date('d/m/Y',strtotime($from_dt)).
                                                ' To '.date('d/m/Y',strtotime($to_dt));
                                     ?></u></h3>
                            </caption>
                            <caption><h5><u><?php echo 'Service Center : '.$srvCtr;?></u></h5></caption>
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>Sl.No.</th>
                                    <th>Invoice No.</th>
                                    <th>Sale Date</th>
                                    <th>Customer Name</th>
                                    <th>Item</th>
                                    <th>Version</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                    for($i=0;$i<sizeof($data['inv_no']);$i++){?>
                                        <tr>
                                            <td><?php echo ($i+1);?></td>
                                            <td><?php echo $data['inv_no'][$i]; ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($data['sale_dt'][$i])); ?></td>
                                            <td><?php echo $data['cust_name'][$i]; ?></td>
                                            <td><?php echo $data['mc_name'][$i]; ?></td>
                                            <td><?php echo $data['mc_ver'][$i]; ?></td>
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