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
                        <th>วันมาซ่อม</th>
                        <th>วันมารับของ</th>
                        <th>วันแจ้งช่างซ่อม</th>
                        <th>วันช่างซ่อมเสร็จ</th>
                        <th>วันแก้ไข</th>
                        <th>ผู้แก้ไข</th>
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
                    $sql_in_repair .= " concat(e.per_fname,'   ',e.per_lname) as employee";
                    $sql_in_repair .= " FROM in_repair b";
                    $sql_in_repair .= " LEFT JOIN repair_assign ra ON ra.rep_id = b.inrep_id";
                    $sql_in_repair .= " LEFT JOIN person p ON p.per_id = b.inrep_updateby";
                    $sql_in_repair .= " LEFT JOIN person e ON e.per_id = ra.rep_repairers";
                    if ($person['per_status'] != 3): // เจ้าของร้านเห็นหมด
                        $sql_in_repair .= " WHERE ra.rep_repairers = $ses_id";
                    endif;
                    $sql_in_repair .= " ORDER BY b.inrep_id";
                    
                    echo print_sql($sql_in_repair);
                    
                    $query_in_repair = mysql_query($sql_in_repair) or die(mysql_error());
                    $row = 1;
                    while ($data = mysql_fetch_array($query_in_repair)):
                        ?>
                        <tr>
                            <td><?= $row ?></td>
                            <td><?= $data['inrep_code'] ?></td>
                            <td><?= format_date('d/m/Y', $data['inrep_createdate']) ?></td>
                            <td><?= format_date('d/m/Y', $data['inrep_getdate']) ?></td>
                            <td><?= format_date('d/m/Y', $data['rep_suppose_startdate']) ?></td>
                            <td><?= format_date('d/m/Y', $data['rep_suppose_enddate']) ?></td>
                            <td><?= format_date('d/m/Y', $data['inrep_updatedate']) ?></td>
                            <td>
                                <div class="label label-success"><?= $data['updateby'] ?></div>
                            </td>
                            <td>
                                <div class="label label-warning"><?= $data['employee'] ?></div>
                            </td>
                            <td>
                                <div class="label label-<?= getDataList($data['inrep_status'], listRepairStatusColor()) ?>">
                                    <?= getDataList(intval($data['inrep_status']), listRepairStatus()) ?>
                                </div>                                
                            </td>
                            <td>
                                <?php if ($_SESSION['person']['per_status'] != EMPLOYEE_STATUS): ?>
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#modal-repair<?= $data['inrep_id'] ?>">
                                        <i class="glyphicon glyphicon-upload"></i> มอบหมายงานซ่อม
                                    </a>
                                    <?php include '../modal/modal_assign_repair.php'; ?>
                                <?php else: ?>
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#modal-send<?= $data['inrep_id'] ?>">
                                        <i class="glyphicon glyphicon-upload"></i> ส่งงาน
                                    </a>
                                    <?php include '../modal/modal_send_repair.php'; ?>
                                <?php endif; ?>
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

