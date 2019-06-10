<?php
        ini_set("display_errors",1);
        error_reporting(E_ALL);

        require("../login/connect.php");
        require("../login/session.php");
        require("../dash/menu.php");


        $data['sl_no']    = [];
        $data['slno']     = [];
        $data['mcname']   = [];
        $data['kol_qty']  = [];  
        $data['sil_qty']  = [];
        $data['acc_qty']  = [];
        $data['bap_qty']  = [];
        $data['bng_qty']  = [];
        $data['dcb_qty']  = [];
        $data['tot_qty']  = [];

        $data['mc_id']    = [];

        if($_SERVER['REQUEST_METHOD']=="POST"){  

            $trans_dt         = $_POST['trans_dt'];
            //$srv              = $_POST['srv_ctr'];
            $item             = $_POST['item'];

            /*$select = "select sl_no,center_name from md_service_centre
                       where sl_no  = $srv";
                   
            $result = mysqli_query($db,$select);

            $row1   = mysqli_fetch_assoc($result);*/

            $srvCtr = 'NA';

            if($item=='C'){
                $item_desc = "Component";
                $sql              = "select sl_no,parts_desc from md_parts";
                $query            = mysqli_query($db,$sql);
                while($slno       = mysqli_fetch_assoc($query)){
                    $sl_no = $slno['sl_no'];
                    array_push($data['sl_no'], $sl_no);
                }

                $parts_type = $data['sl_no'];

                for($i=0;$i<sizeof($parts_type);$i++){
                    $sum    = "Select sum(kol)kol,sum(sil)sil,sum(acc)acc,sum(bap)bap,sum(ban)ban,sum(dcb)dcb,
                               sum(tot)tot
                               from (select sum(comp_qty)kol,0 sil,0 acc,0 bap,0 ban,0 dcb,0 tot 
                                     from td_parts_trans 
                                       where comp_sl_no = $parts_type[$i]
                                       and trans_dt <= '$trans_dt'
                                       and serv_ctr = 1
                                       UNION
                                       select 0 kol,sum(comp_qty)sil,0 acc,0 bap,0 ban,0 dcb,0 tot
                                       from td_parts_trans 
                                       where comp_sl_no = $parts_type[$i]
                                       and trans_dt <= '$trans_dt'
                                       and serv_ctr = 2
                                       UNION
                                       select 0 kol,0 sil,sum(comp_qty)acc,0 bap,0 ban,0 dcb,0 tot
                                       from td_parts_trans 
                                       where comp_sl_no = $parts_type[$i]
                                       and trans_dt <= '$trans_dt'
                                       and serv_ctr = 3
                                       UNION
                                       select 0 kol,0 sil,0 acc,sum(comp_qty)bap,0 ban,0 dcb,0 tot
                                       from td_parts_trans 
                                       where comp_sl_no = $parts_type[$i]
                                       and trans_dt <= '$trans_dt'
                                       and serv_ctr = 4
                                       UNION
                                       select 0 kol,0 sil,0 acc,0 bap,sum(comp_qty) ban,0 dcb,0 tot
                                       from td_parts_trans 
                                       where comp_sl_no = $parts_type[$i]
                                       and trans_dt <= '$trans_dt'
                                       and serv_ctr = 5
                                       UNION
                                       select 0 kol,0 sil,0 acc,0 bap,0 ban,sum(comp_qty) dcb,0 tot
                                       from td_parts_trans 
                                       where comp_sl_no = $parts_type[$i]
                                       and trans_dt <= '$trans_dt'
                                       and serv_ctr = 6
                                       UNION
                                       select 0 kol,0 sil,0 acc,0 bap,0 ban,0 dcb,sum(comp_qty)tot
                                       from td_parts_trans 
                                       where comp_sl_no = $parts_type[$i]
                                       and trans_dt <= '$trans_dt'
                                       )a";

                    $result =  mysqli_query($db,$sum);
                    $row    =  mysqli_fetch_assoc($result);

                    $sql    = "select sl_no,parts_desc from md_parts where sl_no = $parts_type[$i]";
                    $result = mysqli_query($db,$sql);
                    $desc   = mysqli_fetch_assoc($result);

                    array_push($data['slno']    ,$parts_type[$i]);
                    array_push($data['mcname']  ,$desc['parts_desc']);
                    array_push($data['kol_qty'] ,$row['kol']);
                    array_push($data['sil_qty'] ,$row['sil']);
                    array_push($data['acc_qty'] ,$row['acc']);
                    array_push($data['bap_qty'] ,$row['bap']);
                    array_push($data['bng_qty'] ,$row['ban']);
                    array_push($data['dcb_qty'] ,$row['dcb']);
                    array_push($data['tot_qty'] ,$row['tot']);
                }
            }elseif($item=='D'){
                $item_desc        = "Device(Service)";
                $sql              = "select mc_id,mc_type from md_mc_type";
                $query            = mysqli_query($db,$sql);
                while($mcid       = mysqli_fetch_assoc($query)){
                    $mc_id = $mcid['mc_id'];
                    array_push($data['mc_id'], $mc_id);
                }

                $mc_type = $data['mc_id'];

                for($i=0;$i<sizeof($mc_type);$i++){
                    $in    =  "select sum(kol)kol,sum(sil)sil,sum(tot)tot
                               from(
                                       select count(mc_type_id)kol,0 sil,0 tot from td_mc_trans 
                                       where mc_type_id = $mc_type[$i] 
                                       and trans_type   in ('I','S')
                                       and trans_dt    <= '$trans_dt'
                                       and srv_ctr      = 1
                                       and approval_status = 'U'
                                       UNION
                                       select 0 kol,count(mc_type_id) sil,0 tot from td_mc_trans 
                                       where mc_type_id = $mc_type[$i] 
                                       and trans_type   in ('I','S')
                                       and trans_dt    <= '$trans_dt'
                                       and srv_ctr      = 2
                                       and approval_status = 'U'
                                       UNION
                                       select 0 kol,0 sil,count(mc_type_id) tot from td_mc_trans 
                                       where mc_type_id = $mc_type[$i] 
                                       and trans_type   in ('I','S')
                                       and trans_dt    <= '$trans_dt'
                                       and approval_status = 'U')a";

                    $result =  mysqli_query($db,$in);
                    $row    =  mysqli_fetch_assoc($result);

                    $sql    = "select mc_id,mc_type from md_mc_type where mc_id = $mc_type[$i]";
                    $result = mysqli_query($db,$sql);
                    $desc   = mysqli_fetch_assoc($result);

                    array_push($data['slno']    ,$mc_type[$i]);
                    array_push($data['mcname']  ,$desc['mc_type']);
                    array_push($data['kol_qty'] ,$row['kol']);
                    array_push($data['sil_qty'] ,$row['sil']);
                    array_push($data['acc_qty'] ,0);
                    array_push($data['bap_qty'] ,0);
                    array_push($data['bng_qty'] ,0);
                    array_push($data['dcb_qty'] ,0);
                    array_push($data['tot_qty'] ,$row['tot']);
            }   
        }else{
            $item_desc        = "New Device";

            $in    =  "select mc_type,mc_name,sum(kol_qty)kol_qty,sum(sil_qty)sil_qty,
                        sum(acc_qty)acc_qty,sum(bap_qty)bap_qty,sum(bng_qty)bng_qty,sum(dcb_qty)dcb_qty,
                        sum(tot_qty)tot_qty
                        from(
                                select mc_type,mc_name,sum(mc_qty)kol_qty,0 sil_qty,0 acc_qty,0 bap_qty,
                                0 bng_qty,0 dcb_qty,0 tot_qty 
                                from td_device_trans
                                where  arrival_dt <= '$trans_dt'
                                and    approval_status = 'U'
                                and    serv_ctr = 1
                                group by mc_type,mc_name,serv_ctr
                                UNION
                                select mc_type,mc_name,0 kol_qty,sum(mc_qty)sil_qty,0 acc_qty,0 bap_qty,
                                0 bng_qty,0 dcb_qty,0 tot_qty 
                                from td_device_trans
                                where  arrival_dt <= '$trans_dt'
                                and    approval_status = 'U'
                                and    serv_ctr = 2
                                group by mc_type,mc_name,serv_ctr
                                UNION
                                select mc_type,mc_name,0 kol_qty,0 sil_qty,sum(mc_qty)acc_qty,0 bap_qty,
                                0 bng_qty,0 dcb_qty,0 tot_qty 
                               from td_device_trans
                                where  arrival_dt <= '$trans_dt'
                                and    approval_status = 'U'
                                and    serv_ctr = 3
                                group by mc_type,mc_name,serv_ctr
                                UNION
                                select mc_type,mc_name,0 kol_qty,0 sil_qty,0 acc_qty,sum(mc_qty) bap_qty,
                                0 bng_qty,0 dcb_qty,0 tot_qty 
                                from td_device_trans
                                where  arrival_dt <= '$trans_dt'
                                and    approval_status = 'U'
                                and    serv_ctr = 4
                                group by mc_type,mc_name,serv_ctr
                                UNION
                                select mc_type,mc_name,0 kol_qty,0 sil_qty,0 acc_qty,0 bap_qty,
                                sum(mc_qty) bng_qty,0 dcb_qty,0 tot_qty 
                                from td_device_trans
                                where  arrival_dt <= '$trans_dt'
                                and    approval_status = 'U'
                                and    serv_ctr = 5
                                group by mc_type,mc_name,serv_ctr
                                UNION
                                select mc_type,mc_name,0 kol_qty,0 sil_qty,0 acc_qty,0 bap_qty,
                                0 bng_qty,sum(mc_qty) dcb_qty,0 tot_qty 
                                from td_device_trans
                                where  arrival_dt <= '$trans_dt'
                                and    approval_status = 'U'
                                and    serv_ctr = 6
                                group by mc_type,mc_name,serv_ctr
                                UNION
                                select mc_type,mc_name,0 kol_qty,0 sil_qty,0 acc_qty,0 bap_qty, 
                                0 bng_qty,0 dcb_qty,sum(mc_qty)tot_qty
                                from td_device_trans
                                where  arrival_dt <= '$trans_dt'
                                and    approval_status = 'U'
                                group by mc_type,mc_name,serv_ctr)a
                        group by mc_type,mc_name
                        order by mc_type";

            $i=1;           
                       
            $result =  mysqli_query($db,$in);
            while($row    =  mysqli_fetch_assoc($result)){
                array_push($data['slno']    ,$i);
                array_push($data['mcname']  ,$row['mc_name']);
                array_push($data['kol_qty']     ,$row['kol_qty']);
                array_push($data['sil_qty']     ,$row['sil_qty']);
                array_push($data['acc_qty']     ,$row['acc_qty']);
                array_push($data['bap_qty']     ,$row['bap_qty']);
                array_push($data['bng_qty']     ,$row['bng_qty']);
                array_push($data['dcb_qty']     ,$row['dcb_qty']);
                array_push($data['tot_qty']     ,$row['tot_qty']);

                $i++;
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
        <h2 style="margin-left:60px;text-align:center"><?php echo $item_desc.' Stock Position As On : '.date('d/m/Y',strtotime($trans_dt)); ?></h2>
        <hr class="new">
        <div class="card mb-3">
            <!--<div class="card-header" style="margin-left:60px;">

                 <i class="fa fa-home btn btn-primary" >
                    <span><?php echo "Service Center : ".$srvCtr; ?></span>
                </i>
            </div>-->
            <hr class="new">
                <div class="card-body">
                    <div class="w3-responsive" style="margin-left:60px;" id="divToPrint">
                        <table id="dta" class="w3-table-all" width="50%">
                            <caption><h3><u><?php echo $item_desc.' Stock Position As On : '.date('d/m/Y',strtotime($trans_dt));?></u></h3>
                            </caption>
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>Sl.No.</th>
                                    <th>Type</th>
                                    <th>Kolkata</th>
                                    <th>Siliguri</th>
                                    <th>Accropolis</th>
                                    <th>Bappa</th>
                                    <th>Bangladesh</th>
                                    <th>Darjeeling(CCB)</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                    for($i=0;$i<sizeof($data['slno']);$i++){?>
                                        <tr>
                                            <td><?php echo $data['slno'][$i]; ?></td>
                                            <td><?php echo $data['mcname'][$i]; ?></td>
                                            <td><?php echo $data['kol_qty'][$i]; ?></td>
                                            <td><?php echo $data['sil_qty'][$i]; ?></td>
                                            <td><?php echo $data['acc_qty'][$i]; ?></td>
                                            <td><?php echo $data['bap_qty'][$i]; ?></td>
                                            <td><?php echo $data['bng_qty'][$i]; ?></td>
                                            <td><?php echo $data['dcb_qty'][$i]; ?></td>
                                            <td><?php echo $data['tot_qty'][$i]; ?></td>
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