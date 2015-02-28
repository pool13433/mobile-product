<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-phone"></i> รายการ แบบฟอร์มรับซ่อมมือถือ
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=frm-repair_in" class="btn btn-info">
                <i class="glyphicon glyphicon-plus-sign"></i> สร้าง
            </a>
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
                        <th>วันแก้ไข</th>
                        <th>ผู้แก้ไข</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../config/connection.php';
                    $sql_in_repair = "SELECT * FROM in_repair b";
                    $sql_in_repair .= " JOIN person p ON p.per_id = b.inrep_updateby";
                    $sql_in_repair .= " ORDER BY b.inrep_id";
                    $query_in_repair = mysql_query($sql_in_repair) or die(mysql_error());
                    $row = 1;
                    while ($data = mysql_fetch_array($query_in_repair)):
                        ?>
                        <tr>
                            <td><?= $row ?></td>
                            <td><?= $data['inrep_code'] ?></td>
                            <td><?= $data['inrep_createdate'] ?></td>
                            <td><?= $data['inrep_getdate'] ?></td>
                            <td><?= format_date('d/m/Y', $data['inrep_updatedate']) ?></td>
                            <td><?= $data['per_fname'] ?></td>
                            <td>
                                <a href="index.php?page=frm-repair_in&id=<?= $data['inrep_id'] ?>" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="delete_data(<?= $data['inrep_id'] ?>, '../action/in_repair.php?method=delete')">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
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



