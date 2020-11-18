<?php
        ini_set("display_errors",1);
        error_reporting(E_ALL);

        require("../login/connect.php");
        require("../login/session.php");
        require("../dash/menu.php");


        $row['date']            = [];
        $row['transType']       = [];
        $row['billNo']          = [];
        $row['qty']             = [];  
        $row['remarks']         = [];  
        $row['nos']             = [];  
        $tot                    = 0;
        $row['parts']           = [];

        if($_SERVER['REQUEST_METHOD']=="POST"){  

            $from_dt         = $_POST['from_dt'];
            $to_dt           = $_POST['to_dt'];
            $parts_desc      = $_POST['parts_desc'];
            $srv             = $_POST['srv_ctr'];

            $select = "select sl_no,center_name from md_service_centre
                       where sl_no  = $srv";
                   
            $result = mysqli_query($db,$select);
            $row1   = mysqli_fetch_assoc($result);
            $srvCtr = $row1['center_name'];

            $sql = "select max(trans_dt)trans_dt from td_parts_trans 
                    where comp_sl_no    = $parts_desc
                    and   trans_dt   < '$from_dt'
                    and    serv_ctr   = $srv";

            $sqlResult = mysqli_query($db,$sql);
            $data = mysqli_fetch_assoc($sqlResult);

            $opnSelect = "select sum(comp_qty)opn from td_parts_trans
                          where  comp_sl_no    = $parts_desc
                          and    trans_dt      < '$from_dt'
                          and    serv_ctr      = $srv";
                           

            $opnResult =  mysqli_query($db,$opnSelect);

            $opn       = mysqli_fetch_assoc($opnResult);

            $opnBal    = $opn['opn'];

             array_push($row['date']             ,$data['trans_dt']);
             array_push($row['transType']        ,'N');
             array_push($row['billNo']           ,'');
             array_push($row['qty']              ,$opnBal);
             array_push($row['remarks']          ,'');
             array_push($row['nos']              ,1);



            $sql              = "select sl_no,parts_desc from md_parts
                                 where sl_no = $parts_desc";
            $query            = mysqli_query($db,$sql);
            $slno             = mysqli_fetch_assoc($query);
            $parts            = $slno['parts_desc'];

            $select =  "select * from td_parts_trans
                        where trans_dt between '$from_dt' and '$to_dt'
                        and   comp_sl_no = $parts_desc
                        and   serv_ctr   = $srv
                        order by trans_dt,trans_no";

            
            $result = mysqli_query($db,$select);
            $nos    = mysqli_num_rows($result);
            while($data   = mysqli_fetch_assoc($result)){
                array_push($row['date']             ,$data['trans_dt']);
                array_push($row['transType']        ,$data['trans_type']);
                array_push($row['billNo']           ,$data['bill_no']);
                array_push($row['qty']              ,$data['comp_qty']);
                array_push($row['remarks']          ,$data['remarks']);
                array_push($row['nos']              ,$nos);
            }

        }
?>

<html>
<head>
    <title>Component Ledger</title>
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
        <h2 style="margin-left:60px;text-align:center"><?php echo 'Stock Ledger Between : '.date('d/m/Y',strtotime($from_dt)).' To '.date('d/m/Y',strtotime($to_dt)); ?></h2>
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
                            <caption><h3><u><?php echo 'Stock Ledger Between '.date('d/m/Y',strtotime($from_dt)).' To '.date('d/m/Y',strtotime($to_dt)).' for '.$srvCtr;
                                     ?></u></h3>
                             <br>
                             <h4><?php echo 'Component : '.$parts;?></h4>
                            </caption>
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Bill No.</th>
                                    <th>Remarks</th>
                                    <th>Quantity</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php

                                    for($i=0;$i<sizeof($row['nos']);$i++){?>
                                        <tr>
                                            <td><?php echo date('d/m/Y',strtotime($row['date'][$i])); ?></td>
                                            <td><?php if($row['transType'][$i]=="I"){
                                                         echo "In";
                                                      }elseif($row['transType'][$i]=="T"){
                                                         echo "Transfer Out";
                                                      }elseif($row['transType'][$i]=="O"){
                                                         echo "Service Out";
                                                      }elseif($row['transType'][$i]=="L"){
                                                         echo "Sale Out";
                                                      }elseif($row['transType'][$i]=="N"){
                                                         echo "Opening";
                                                      }else{
                                                         echo "Damage Out";   
                                                      } 
                                                ?>
                                            </td>
                                            <td><?php echo $row['billNo'][$i];   ?></td>
                                            <td><?php echo $row['remarks'][$i];  ?></td>
                                            <td><?php echo abs($row['qty'][$i]); ?></td>
                                            <td><?php $tot= $tot + $row['qty'][$i];
                                                        echo $tot;
                                                ?>
                                            </td>
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
