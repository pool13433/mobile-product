<?php
$person = '';
$ses_id = '';
if (!empty($_SESSION['person'])):
    $person = $_SESSION['person'];
    $ses_id = $person['per_id'];
endif;
?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-phone"></i> รายการ ซ่อมมือถือ
        </h4>
        <div class="btn-group pull-right">
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>รหัส</th>
                        <th>วันแจ้งช่างซ่อม</th>
                        <th>วันช่างซ่อมเสร็จ</th>
                        <th>พนักงานซ่อม</th>                                        
                        <th>สถานการซ่อม</th>  
                        <th>มอบหมาย</th>                              
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../config/connection.php';
                    $sql_in_repair = "SELECT b.*,ra.*,";
                    $sql_in_repair .= " concat(p.per_fname,'    ',p.per_lname) as updateby,";
                    $sql_in_repair .= " concat(e.per_fname,'   ',e.per_lname) as employee,";
                    $sql_in_repair .= " c.*";
                    $sql_in_repair .= " FROM in_repair b";
                    $sql_in_repair .= " LEFT JOIN repair_assign ra ON ra.rep_id = b.inrep_id";
                    $sql_in_repair .= " LEFT JOIN person p ON p.per_id = b.inrep_updateby";
                    $sql_in_repair .= " LEFT JOIN person e ON e.per_id = ra.rep_repairers";
                    $sql_in_repair .= " LEFT JOIN person c ON c.per_id = b.per_id";
                    $sql_in_repair .= " WHERE 1=1 ";
                    if ($person['per_status'] == EMPLOYEE_STATUS) { // พนักงาน จะไม่เห็น การซ่อมที่ถูกยกเลิก
                        $sql_in_repair .= " AND ra.rep_repairers = $ses_id";
                        $sql_in_repair .= " AND b.inrep_status != 4";  // 4 => 'ยกเลิก/ไม่อนุมัติการซ่อม จากลูกค้า',                      
                    } else if ($person['per_status'] == CUSTOMER_STATUS) {
                        //$sql_in_repair .= " AND b.inrep_status IN (2,3,4,5,6,7,8,9,10)";  // 4 => 'ยกเลิก/ไม่อนุมัติการซ่อม จากลูกค้า',
                        $sql_in_repair .= " AND b.per_id = $ses_id";
                    }
                    $sql_in_repair .= " ORDER BY b.inrep_id";

                    echo print_sql($sql_in_repair);

                    $query_in_repair = mysql_query($sql_in_repair) or die(mysql_error());
                    $row = 1;
                    while ($data = mysql_fetch_array($query_in_repair)):
                        ?>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-view<?= $data['inrep_id'] ?>">
                                    <i class="glyphicon glyphicon-eye-open"></i> <?= $row ?>
                                </button>
                                <?php include '../modal/modal_repair_in_detail.php'; ?>
                            </td>
                            <td><?= $data['inrep_code'] ?></td>
                            <td><?= format_date('d/m/Y', $data['rep_suppose_startdate']) ?></td>
                            <td><?= format_date('d/m/Y', $data['rep_suppose_enddate']) ?></td>                            
                            <td>
                                <div class="label label-warning"><?= $data['employee'] ?></div>
                            </td>
                            <td>
                                <div class="label label-<?= getDataList($data['inrep_status'], listRepairStatusColor()) ?>">
                                    <?= getDataList(intval($data['inrep_status']), listRepairStatus()) ?>
                                </div>                                
                            </td>
                            <td>
                                <?php if ($_SESSION['person']['per_status'] == ONWER_STATUS) { ?>
                                    <?php if ($data['inrep_status'] == 1) { // รอประเมิน  ?>
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#modal-repair<?= $data['inrep_id'] ?>">
                                            <i class="glyphicon glyphicon-upload"></i> มอบหมายงานซ่อม
                                        </a>
                                        <?php include '../modal/modal_assign_repair.php'; ?>
                                    <?php } else if ($data['inrep_status'] == 6 || $data['inrep_status'] == 7) { // 6 => 'ซ่อมเสร็จแล้ว',7 => 'เกิดปัญหา',?>
                                        <a class="btn btn-success" data-toggle="modal" data-target="#modal-finish<?= $data['inrep_id'] ?>" onclick="load_accessory(<?= $data['inrep_id'] ?>)">
                                            <i class="glyphicon glyphicon-ok-circle"></i> ส่งของลูกค้า
                                        </a>
                                        <?php include '../modal/modal_finish_repair.php'; ?>
                                    <?php } ?>                                    
                                <?php } else if ($_SESSION['person']['per_status'] == EMPLOYEE_STATUS) { ?>
                                    <?php if ($data['inrep_status'] == 1) { // รอประเมิน  ?>
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#modal-appraisers<?= $data['inrep_id'] ?>">
                                            <i class="glyphicon glyphicon-adjust"></i> ประเมิน 
                                        </a>
                                        <?php include '../modal/modal_appraisers_repair.php'; ?>
                                    <?php } else if ($data['inrep_status'] == 3) { //  3 => 'อนุมัติการซ่อม จากลูกค้าเรียบร้อยแล้ว',4 => 'ไม่ อนุมัติการซ่อม จากลูกค้า',  ?>                                        
                                        <button type="button" class="btn btn-primary" onclick="start_repair(5,<?= $data['inrep_id'] ?>)">
                                            <i class="glyphicon glyphicon-tint"></i> เริ่มการซ่อม
                                        </button>
                                    <?php } else if ($data['inrep_status'] == 5) { // 5  = กำลังซ่อม จึงส่งงานได้?>
                                        <a class="btn btn-success" data-toggle="modal" data-target="#modal-send<?= $data['inrep_id'] ?>">
                                            <i class="glyphicon glyphicon-upload"></i> ส่งงาน 
                                        </a>
                                        <?php include '../modal/modal_send_repair.php'; ?>       
                                    <?php } else { ?>
                                        <span class="label label-<?= getDataList($data['inrep_status'], listRepairStatusColor()) ?>"><?= getDataList($data['inrep_status'], listRepairStatus()) ?></span>
                                    <?php } ?>
                                <?php } else if ($_SESSION['person']['per_status'] == CUSTOMER_STATUS) { ?>
                                    <?php if ($data['inrep_status'] == 2) { // รอ ลุกค้า อนุมัติ  ?>
                                        <a class="btn btn-info" onclick="approve_repair(3,<?= $data['inrep_id'] ?>)">
                                            <i class="glyphicon glyphicon-ok-sign"></i> อนุมัติการซ่อม 
                                        </a>      
                                        <a class="btn btn-danger" onclick="approve_repair(4,<?= $data['inrep_id'] ?>)">
                                            <i class="glyphicon glyphicon-remove-sign"></i> ไม่ อนุมัติการซ่อม (ยกเลิกการซ่อม)
                                        </a>   
                                    <?php } else if (intval($data['inrep_status']) != 2 && $data['inrep_status'] != 4) { // 3 = อนัติไปแล้ว ?>
                                        <span class="label label-success"><?= getDataList($data['inrep_status'], listRepairStatus()) ?> กรุณารอ...</span>
                                    <?php } else { ?>
                                        <span class="label label-danger">ท่านยกเลิกไปแล้ว จบงานซ่อม[<?= $data['inrep_status'] ?>]</span>
                                    <?php } ?>
                                <?php } else { ?>
                                    <?= $_SESSION['person']['per_status'] ?>
                                <?php } ?>                                
                            </td>                            
                        </tr>             
                        <?php
                        $row++;
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    function approve_repair(status, repair_id) {
        var conf = confirm('ยืนยันการเปลี่ยนแปลง สถานะ การซ่อม ใช่ [OK] || ยกเลิก [Cancle]');
        if (conf) {
            $.post('../action/repair_assign.php?method=update_approve',
                    {
                        repair_id: repair_id,
                        status: status
                    },
            function(data) {
                if (data.status == 'success') {
                    showNotification('success', data.title, data.msg, 3);
                    reloadDelay(2);
                } else {
                    showNotification('danger', data.title, data.msg, 3);
                }
            }, 'json');
            return true;
        }
    }
    function start_repair(repair_status, repair_id) {
        var conf = confirm('ยืนยันการเริ่มซ่อม ใช่ [OK] || ไม่ใช่ [Cancle]');
        if (conf) {
            $.post('../action/repair_assign.php?method=start_repair',
                    {
                        repair_status: repair_status,
                        repair_id: repair_id
                    }, function(data) {
                showNotification('success', data.title, data.msg, 3);
                if (data.status == 'success') {

                    reloadDelay(2);
                }
            }, 'json');
        }
    }

</script>

