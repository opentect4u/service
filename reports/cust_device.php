<?php
        ini_set("display_errors",1);
        error_reporting(E_ALL);

        require("../login/connect.php");
        require("../login/session.php");
        require("../dash/menu.php");

        $data['date']     = [];
        $data['tkt']      = [];
        $data['mcname']   = [];
        $data['sl']       = [];
        $data['prob']     = [];
        $data['srv']      = []; 

        if($_SERVER['REQUEST_METHOD']=="POST"){  

            $from_dt         = $_POST['from_dt'];
            $to_dt           = $_POST['to_dt'];
            $cust_cd         = $_POST['cust_cd'];
    
            $select = "select cust_cd,cust_name from md_customers
                       where  cust_cd  = '$cust_cd'";
                   
            $result = mysqli_query($db,$select);

            $row1   = mysqli_fetch_assoc($result);

            $custCd  = $row1['cust_name'];

   
            $sql    = "select a.trans_dt trans_dt,
                              a.trans_cd trans_cd,
                              a.mc_type_id,
                              a.sl_no sl_no,
                              a.mc_prob,
                              a.srv_ctr,
                              c.mc_type mc_type,
                              d.problem_desc prob_desc,
                              e.center_name srv_name
                        from   td_mc_trans a,
                               md_mc_type c,
                               md_problem d,
                               md_service_centre e
                        where  a.mc_type_id = c.mc_id
                        and    a.mc_prob    = d.sl_no
                        and    a.srv_ctr    = e.sl_no
                        and    a.cust_cd    = '$cust_cd'
                        and    a.trans_type = 'I'
                        and    a.trans_dt between '$from_dt' and '$to_dt'";
           
            $result =  mysqli_query($db,$sql);

            while($row   =  mysqli_fetch_assoc($result)){
                
                array_push($data['date']    ,$row['trans_dt']);
                array_push($data['tkt']     ,$row['trans_cd']);
                array_push($data['mcname']  ,$row['mc_type']);
                array_push($data['sl']      ,$row['sl_no']);
                array_push($data['prob']    ,$row['prob_desc']);
                array_push($data['srv']     ,$row['srv_name']);
               } 
        }    
?>

<html>
<head>
    <title>Device Details</title>
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
        <h2 style="margin-left:60px;text-align:center"><?php echo 'Device Submitted Between : '.date('d/m/Y',strtotime($from_dt)).' To '.date('d/m/Y',strtotime($to_dt)); ?></h2>
        <hr class="new">
        <div class="card mb-3">
            <div class="card-header" style="margin-left:60px;">

                 <i class="fa fa-asterisk btn btn-primary" >
                    <span><?php echo "Customer : ".$custCd; ?></span>
                </i>
                
                
            </div>
            <hr class="new">
                <div class="card-body">
                    <div class="w3-responsive" style="margin-left:60px;" id="divToPrint">
                        <table id="dta" class="w3-table-all" width="50%">
                            <caption><h3><u><?php echo 'Device Submitted Between : '.date('d/m/Y',strtotime($from_dt)).
                                                ' To '.date('d/m/Y',strtotime($to_dt));
                                     ?></u></h3>
                            </caption>
                            <caption><h5><u><?php echo 'Customer : '.$custCd;?></u></h5></caption>
                            <thead>
                                <tr class="w3-light-grey">
                                    <th></th>
                                    <th>Date</th>
                                    <th>Ticket No.</th>
                                    <th>Type</th>
                                    <th>Sl.No.</th>
                                    <th>Fault</th>
                                    <th>Service Center</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                    for($i=0;$i<sizeof($data['sl']);$i++){?>
                                        <tr>
                                            <td><?php echo ($i+1);?></td>
                                            <td><?php echo date('d/m/Y',strtotime($data['date'][$i])); ?></td>
                                            <td><?php echo $data['tkt'][$i]; ?></td>
                                            <td><?php echo $data['mcname'][$i]; ?></td>
                                            <td><?php echo $data['sl'][$i]; ?></td>
                                            <td><?php echo $data['prob'][$i]; ?></td>
                                            <td><?php echo $data['srv'][$i]; ?></td>
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