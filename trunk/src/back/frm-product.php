<?php
include '../config/connection.php';
$id = "";
$name = "";
$desc = "";
$color = "";
$model = "";
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM product WHERE prod_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
    $id = $data['prod_id'];
    $name = $data['prod_name'];
    $desc = $data['prod_desc'];
    $color = $data['col_id'];
    $model = $data['mod_id'];
}
?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-phone"></i> มือถือ
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=list-product" class="btn btn-warning">
                <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
            </a>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <form class="form-horizontal" name="frm-product" id="frm-product">
                <div class="form-group">
                    <label for="input-name" class="col-sm-2 control-label">ชื่อ</label>
                    <div class="col-sm-6">
                        <input type="hidden" name="input-id" value="<?= $id ?>"/>
                        <input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก ชื่อ"
                               name="input-name" id="input-name" value="<?= $name ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-desc" class="col-sm-2 control-label">รายละเอียด</label>
                    <div class="col-sm-6">
                        <textarea class="form-control validate[required]"
                                  data-errormessage-value-missing="กรุณากรอก รายละเอียด"
                                  name="input-desc" id="input-desc"><?= $desc ?></textarea>                        
                    </div>
                </div> 
                <div class="form-group">
                    <label for="combo-model" class="col-sm-2 control-label">รุ่นโทรศัพท์</label>
                    <div class="col-sm-3">
                        <select class="form-control validate[required]" name="combo-model" id="combo-model"
                                data-errormessage-value-missing="กรุณาเลือก รุ่น">
                            <option value="" selected>-- เลือก --</option>
                            <?php
                            $sql_model = "SELECT * FROM model";
                            $query_model = mysql_query($sql_model) or die(mysql_error());
                            ?>
                            <?php while ($data = mysql_fetch_array($query_model)): ?>
                                <?php if ($model == $data['mod_id']): ?>
                                    <option value="<?= $data['mod_id'] ?>" selected><?= $data['mod_nameth'] ?>( <?= $data['mod_nameeng'] ?> )</option>
                                <?php else: ?>
                                    <option value="<?= $data['mod_id'] ?>"><?= $data['mod_nameth'] ?>( <?= $data['mod_nameeng'] ?> )</option>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="combo-color" class="col-sm-2 control-label">สีเครื่อง</label>
                    <div class="col-sm-3">
                        <select class="form-control validate[required]" name="combo-color" id="combo-color"
                                data-errormessage-value-missing="กรุณาเลือก สีเครื่อง">
                            <option value="" selected>-- เลือก --</option>
                            <?php
                            $sql_color = "SELECT * FROM color";
                            $query_color = mysql_query($sql_color) or die(mysql_error());
                            ?>
                            <?php while ($data = mysql_fetch_array($query_color)): ?>
                                <?php if ($color == $data['col_id']): ?>
                                    <option value="<?= $data['col_id'] ?>" selected><?= $data['col_nameth'] ?>( <?= $data['col_nameeng'] ?> )</option>
                                <?php else: ?>
                                    <option value="<?= $data['col_id'] ?>"><?= $data['col_nameth'] ?>( <?= $data['col_nameeng'] ?> )</option>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">
                            <i class="glyphicon glyphicon-saved"></i> บันทึก
                        </button>
                        <a href="index.php?page=list-product" class="btn btn-warning">
                            <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var valid = $('#frm-product').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                console.log('status :' + status);
                if (status == true) {
                    post_form('frm-product', '../action/product.php?method=create');
                }
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>