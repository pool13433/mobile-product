<?php
include '../config/connection.php';
$id = "";
$nameth = "";
$nameeng = "";
$brand = "";
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM model WHERE mod_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
    $id = $data['mod_id'];
    $nameth = $data['mod_nameth'];
    $nameeng = $data['mod_nameeng'];
    $brand = $data['bra_id'];
}
?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-bell"></i> สีสินค้า
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=list-model" class="btn btn-warning">
                <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
            </a>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <form class="form-horizontal" name="frm-model" id="frm-model">
                <div class="form-group">
                    <label for="input-nameth" class="col-sm-2 control-label">ชื่อไทย</label>
                    <div class="col-sm-6">
                        <input type="hidden" name="input-id" value="<?= $id ?>"/>
                        <input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก ชื่อไทย"
                               name="input-nameth" id="input-nameth" value="<?= $nameth ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-nameeng" class="col-sm-2 control-label">ชื่ออังกฤษ</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก ชื่ออังกฤษ"
                               name="input-nameeng" id="input-nameeng" value="<?= $nameeng ?>"/>
                    </div>
                </div>   
                <div class="form-group">
                    <label for="combo-brand" class="col-sm-2 control-label">ยี้ห้อ</label>
                    <div class="col-sm-3">
                        <select class="form-control validate[required]" name="combo-brand" id="combo-brand"
                                data-errormessage-value-missing="กรุณาเลือก ยี้ห้อ">
                            <option value="" selected>-- เลือก --</option>
                            <?php
                            $sql_brand = "SELECT * FROM brand";
                            $query_brand = mysql_query($sql_brand) or die(mysql_error());
                            ?>
                            <?php while ($data = mysql_fetch_array($query_brand)): ?>
                                <?php if ($brand == $data['bra_id']): ?>
                                    <option value="<?= $data['bra_id'] ?>" selected><?= $data['bra_nameth'] ?>( <?= $data['bra_nameeng'] ?> )</option>
                                <?php else: ?>
                                    <option value="<?= $data['bra_id'] ?>"><?= $data['bra_nameth'] ?>( <?= $data['bra_nameeng'] ?> )</option>
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
                        <a href="index.php?page=list-model" class="btn btn-warning">
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
        var valid = $('#frm-model').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                console.log('status :' + status);
                if (status == true) {
                    post_form('frm-model', '../action/model.php?method=create');
                }
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>