<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-phone"></i> รายการ รุ่นโทรศัพท์
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=frm-model" class="btn btn-info">
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
                        <th>ชื่อไทย</th>
                        <th>ชื่ออังกฤษ</th>
                        <th>ชื่อยี้ห้อ</th>
                        <th>วันที่แก้ไข</th>
                        <th>ผู้แก้ไข</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../config/connection.php';
                    $sql_model = "SELECT * FROM model m";
                    $sql_model .= " LEFT JOIN brand b ON b.bra_id = m.bra_id";
                    $sql_model .= " LEFT JOIN person p ON p.per_id = m.mod_updateby";
                    $sql_model .= " ORDER BY b.bra_id";
                    $query_model = mysql_query($sql_model) or die(mysql_error());
                    $row = 1;
                    while ($data = mysql_fetch_array($query_model)):
                        ?>
                        <tr>
                            <td><?= $row ?></td>
                            <td><?= $data['mod_nameth'] ?></td>
                            <td><?= $data['mod_nameeng'] ?></td>
                            <td><?= $data['bra_nameth'] ?>( <?=$data['bra_nameeng']?>)</td>
                            <td><?= format_date('d/m/Y', $data['mod_updatedate']) ?></td>
                            <td><?= $data['per_fname'] ?></td>
                            <td>
                                <a href="index.php?page=frm-model&id=<?= $data['mod_id'] ?>" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="delete_data(<?= $data['mod_id'] ?>, '../action/model.php?method=delete')">
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

