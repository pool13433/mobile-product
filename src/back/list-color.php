<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-bell"></i> สีสินค้า
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=frm-color" class="btn btn-info">
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
                        <th>วันที่แก้ไข</th>
                        <th>ผู้แก้ไข</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../config/connection.php';
                    $sql_color = " SELECT * FROM color c";
                    $sql_color .= " JOIN person p ON p.per_id = c.col_updateby";
                    $sql_color .= " ORDER BY c.col_id";
                    $query_color = mysql_query($sql_color) or die(mysql_error());
                    $row = 1;
                    while ($data = mysql_fetch_array($query_color)):
                        ?>
                        <tr>
                            <td><?= $row ?></td>
                            <td><?= $data['col_nameth'] ?></td>
                            <td><?= $data['col_nameeng'] ?></td>
                            <td><?= format_date('d/m/Y', $data['col_updatedate']) ?></td>
                            <td><?= $data['per_fname'] ?></td>
                            <td>
                                <a href="index.php?page=frm-color&id=<?= $data['col_id'] ?>" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="delete_data(<?= $data['col_id'] ?>, '../action/color.php?method=delete')">
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

