<?php
        ini_set("display_errors",1);
        error_reporting(E_ALL);

        require("../login/connect.php");
        require("../login/session.php");
        require("../dash/menu.php");

        $data['trf_dt']         = [];
        $data['item']           = [];
        $data['from']           = [];
        $data['to']             = [];
        $data['mode']           = [];
        $data['qty']            = [];
        $data['rkms']           = [];
        

        if($_SERVER['REQUEST_METHOD']=="POST"){  

            $from_dt         = $_POST['from_dt'];
            $to_dt           = $_POST['to_dt'];
            
            $sql    = "SELECT trans_dt,
                              trans_no,
                              mc_type,
                              mc_name,
                              abs(mc_qty)mc_qty,
                              serv_ctr,
                              srv_to,
                              trf_mode,
                              remarks
                       from   td_device_trans 
                       where  arrival_dt between '$from_dt' and '$to_dt'
                       and    trans_type = 'T'
                       order by trans_dt,trans_no";
           
            $result =  mysqli_query($db,$sql);

            while($row   =  mysqli_fetch_assoc($result)){

                $srvFrm         = $row['serv_ctr'];
                $frmSql         = "select sl_no,center_name from md_service_centre where sl_no = $srvFrm";
                $frmResult      = mysqli_query($db,$frmSql);
                $frmRow         = mysqli_fetch_assoc($frmResult);

                $srvTo          = $row['srv_to'];
                $toSql          = "select sl_no,center_name from md_service_centre where sl_no = $srvTo";
                $toResult       = mysqli_query($db,$toSql);
                $toRow          = mysqli_fetch_assoc($toResult);

                array_push($data['trf_dt']      ,$row['trans_dt']);
                array_push($data['item']        ,$row['mc_name']);
                array_push($data['from']        ,$frmRow['center_name']);
                array_push($data['to']          ,$toRow['center_name']);
                array_push($data['mode']        ,$row['trf_mode']);
                array_push($data['qty']         ,$row['mc_qty']);
                array_push($data['rkms']        ,$row['remarks']);
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
        <h2 style="margin-left:60px;text-align:center"><?php echo 'Device Transfer Between : '.date('d/m/Y',strtotime($from_dt)).' To '.date('d/m/Y',strtotime($to_dt)); ?></h2>
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
                            <caption><h3><u><?php echo 'Device Transfer Between : '.date('d/m/Y',strtotime($from_dt)).
                                                ' To '.date('d/m/Y',strtotime($to_dt));
                                     ?></u></h3>
                            </caption>
                            <!--<caption><h5><u><?php echo 'Service Center : '.$srvCtr;?></u></h5></caption>-->
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>Sl.No.</th>
                                    <th>Date</th>
                                    <th>Item</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Mode</th>
                                    <th>Quantity</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                    for($i=0;$i<sizeof($data['trf_dt']);$i++){?>
                                        <tr>
                                            <td><?php echo ($i+1);?></td>
                                            <td><?php echo date('d/m/Y',strtotime($data['trf_dt'][$i])); ?></td>
                                            <td><?php echo $data['item'][$i]; ?></td>
                                            <td><?php echo $data['from'][$i]; ?></td>
                                            <td><?php echo $data['to'][$i]; ?></td>
                                            <td><?php if($data['mode'][$i]=='C'){
                                                        echo "Courier";  
                                                      }elseif($data['mode'][$i]=='T'){
                                                        echo "Transport";  
                                                      }else{
                                                        echo "Manual";
                                                      }
                                                ?>
                                            </td>
                                            <td><?php echo $data['qty'][$i]; ?></td>
                                            <td><?php echo $data['rkms'][$i]; ?></td>
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