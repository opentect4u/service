<?php
        ini_set("display_errors",1);
        error_reporting(E_ALL);

        require("../login/connect.php");
        require("../login/session.php");
        require("../dash/menu.php");

        if($_SERVER['REQUEST_METHOD']=="POST"){  

            //$item            = $_POST['mc_type'];
            $serial          = $_POST['sl_no'];

            $selectDt = "select max(a.arrival_dt)sale_dt 
                         from   td_device_trans a,td_device_amc b
                         where  a.trans_dt = b.trans_dt
                         and    a.trans_no = b.trans_no
                         and    b.sl_no    = '$serial'";

            $resultDt = mysqli_query($db,$selectDt);

            $dataDt   = mysqli_fetch_assoc($resultDt);


            $slDate     = $dataDt['sale_dt'];
            

            $select = "select a.cust_cd cust_cd,a.bill_no bill_no,
                              a.mc_version version,a.warranty_period period,
                              b.amc_from amc_from,b.amc_to amc_to,b.mc_type mc_type
                       from   td_device_trans a,td_device_amc b
                       where  a.trans_dt = b.trans_dt
                       and    a.trans_no = b.trans_no
                       and    b.sl_no    = '$serial'
                       and    a.arrival_dt = '$slDate'";

            $result = mysqli_query($db,$select);

            $data   = mysqli_fetch_assoc($result);

            $custCd     = $data['cust_cd'];
            $version    = $data['version'];
            $invNo      = $data['bill_no'];
            
            $frmDate    = $data['amc_from'];
            $toDate     = $data['amc_to'];
            $item       = $data['mc_type'];
            
            $sql        = "select cust_cd,cust_name from md_customers where cust_cd = $custCd";
            $result     = mysqli_query($db,$sql);
            $row        = mysqli_fetch_assoc($result);
            $custName   = $row['cust_name'];

            $sql1       = "select mc_id,mc_type from md_mc_type where mc_id = $item";
            $result1    = mysqli_query($db,$sql1);
            $row1       = mysqli_fetch_assoc($result1);
            $itemName   = $row1['mc_type'];

            $sql2       = "select sl_no,version_name from md_version where sl_no = $version";
            $result2    = mysqli_query($db,$sql2);
            $row2       = mysqli_fetch_assoc($result2);
            $verName    = $row2['version_name'];

        }
?>

<html>
<head>
    <title>Warranty Status</title>
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
        <h2 style="margin-left:60px;text-align:center">Warranty Status</h2>
        <hr class="new">
        <div class="card mb-3">
            <div class="card-header" style="margin-left:60px;">
                 <i class="fa fa-home btn btn-primary" >
                    <span><?php echo "Customer Name : ".$custName; ?></span>
                </i>
            </div>

            <hr class="new">
                <div class="card-body">
                    <div class="w3-responsive" style="margin-left:60px;" id="divToPrint">
                        <table id="dta" class="w3-table-all" width="50%">
                            <caption><h3><u>Warranty Status</u></h3></caption>
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>Customer</th>
                                    <th>Item</th>
                                    <th>Version</th>
                                </tr>
                            </thead>
                           <tbody>
                                <tr>
                                    <td><?php echo $custName; ?></td>
                                    <td><?php echo $itemName;?></td>
                                    <td><?php echo $verName; ?></td>
                                </tr>    
                            </tbody>   
                        </table>
                        <table id="dta" class="w3-table-all" width="50%">
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>Invoice No.</th>
                                    <th>Sale Date</th>
                                    <th>Warranty Period</th>
                                </tr>
                            </thead>
                           <tbody>
                                <tr>
                                    <td><?php echo $invNo;?></td>
                                    <td><?php echo date('d/m/Y',strtotime($slDate));?></td>
                                    <td><?php echo date('d/m/Y',strtotime($frmDate)).' - '.date('d/m/Y',strtotime($toDate));?></td>
                                </tr>    
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
