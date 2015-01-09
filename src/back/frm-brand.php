<?php
include '../config/connection.php';
$id = "";
$nameth = "";
$nameeng = "";
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM brand WHERE bra_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
    $id = $data['bra_id'];
    $nameth = $data['bra_nameth'];
    $nameeng = $data['bra_nameeng'];
}
?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-bell"></i> สีสินค้า
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=list-brand" class="btn btn-warning">
                <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
            </a>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <form class="form-horizontal" name="frm-brand" id="frm-brand">
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
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">
                            <i class="glyphicon glyphicon-saved"></i> บันทึก
                        </button>
                        <a href="index.php?page=list-brand" class="btn btn-warning">
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
        var valid = $('#frm-brand').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                console.log('status :' + status);
                if (status == true) {
                    post_form('frm-brand', '../action/brand.php?method=create');
                }
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>