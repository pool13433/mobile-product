<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-user"></i> ผู้ใช้งานในระบบ
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=frm-person" class="btn btn-info">
                <i class="glyphicon glyphicon-plus-sign"></i> สร้าง
            </a>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered dataTable" data-defaultsort="desc">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อ-สกุล</th>
                        <th>โทรศัพท์</th>
                        <th>อีเมลล์</th>
                        <th>ที่อยู่</th>
                        <th>สถานะ</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../config/connection.php';
                    $sql_person = "SELECT * FROM person ORDER BY per_id";
                    $query_person = mysql_query($sql_person) or die(mysql_error());
                    $row = 1;
                    while ($data = mysql_fetch_array($query_person)):
                        ?>
                        <tr>
                            <td><?= $row ?></td>
                            <td><?= $data['per_fname'] . "  " . $data['per_lname'] ?></td>
                            <td><?= $data['per_mobile'] ?></td>
                            <td><?= $data['per_email'] ?></td>
                            <td><?= $data['per_address'] ?></td>
                            <td>
                                <span class="label label-<?= getDataList($data['per_status'], listPersonStatusColor()) ?>">
                                    <?= getDataList($data['per_status'], listPersonStatus()) ?>
                                </span>
                            </td>
                            <td>
                                <a href="index.php?page=frm-person&id=<?= $data['per_id'] ?>" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="delete_data(<?= $data['per_id'] ?>, '../action/person.php?method=delete')">
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

