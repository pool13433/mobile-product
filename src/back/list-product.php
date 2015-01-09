<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-phone"></i> รายการ มือถือ ทั้งหมด
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=frm-product" class="btn btn-info">
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
                    $sql_product = "SELECT * FROM product b";
                    $sql_product .= " JOIN person p ON p.per_id = b.prod_updateby";
                    $sql_product .= " ORDER BY b.prod_id";
                    $query_product = mysql_query($sql_product) or die(mysql_error());
                    $row = 1;
                    while ($data = mysql_fetch_array($query_product)):
                        ?>
                        <tr>
                            <td><?= $row ?></td>
                            <td><?= $data['prod_name'] ?></td>
                            <td><?= $data['prod_desc'] ?></td>
                            <td><?= format_date('d/m/Y', $data['prod_updatedate']) ?></td>
                            <td><?= $data['per_fname'] ?></td>
                            <td>
                                <a href="index.php?page=frm-product&id=<?= $data['prod_id'] ?>" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="delete_data(<?= $data['prod_id'] ?>, '../action/product.php?method=delete')">
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

