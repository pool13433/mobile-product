<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-phone"></i> รายการ อุปกรณ์เสริมของเครื่องโทรศัพท์
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=frm-accessory" class="btn btn-info">
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
                        <th>ชื่อ</th>
                        <th>คำอธิบาย</th>
                        <th>วันที่แก้ไข</th>
                        <th>ผู้แก้ไข</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../config/connection.php';
                    $sql_accessory = "SELECT * FROM accessory b";
                    $sql_accessory .= " JOIN person p ON p.per_id = b.acc_updateby";
                    $sql_accessory .= " ORDER BY b.acc_id";
                    $query_accessory = mysql_query($sql_accessory) or die(mysql_error());
                    $row = 1;
                    while ($data = mysql_fetch_array($query_accessory)):
                        ?>
                        <tr>
                            <td><?= $row ?></td>
                            <td><?= $data['acc_name'] ?></td>
                            <td><?= $data['acc_desc'] ?></td>
                            <td><?= format_date('d/m/Y', $data['acc_updatedate']) ?></td>
                            <td><?= $data['per_fname'] ?></td>
                            <td>
                                <a href="index.php?page=frm-accessory&id=<?= $data['acc_id'] ?>" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="delete_data(<?= $data['acc_id'] ?>, '../action/accessory.php?method=delete')">
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

