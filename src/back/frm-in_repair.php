<?php
include '../config/connection.php';
$id = "";
$nameth = "";
$nameeng = "";
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM in_repair WHERE inrep_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
    $id = $data['inrep_id'];
    $nameth = $data['inrep_code'];
    $nameeng = $data['inrep_createdate'];
}
?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-bell"></i> แบบฟอร์มรับซ่อมมือถือ
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=list-in_repair" class="btn btn-warning">
                <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
            </a>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <form class="form-horizontal" name="frm-in_repair" id="frm-in_repair">
                <div class="form-group">
                    <label for="input-nameth" class="col-sm-1 control-label">เลขที่</label>
                    <div class="col-sm-3">
                        <input type="hidden" name="input-id" value="<?= $id ?>"/>
                        <input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก เลขที่ซ่อม"
                               name="input-nameth" id="input-nameth" value="<?= $nameth ?>"/>
                    </div>
                    <label  class="col-sm-3 control-label"></label>
                    <label for="input-nameth" class="col-sm-2 control-label">วันที่ซ่อม</label>
                    <div class="col-sm-2 input-append date">
                        <input type="hidden" name="input-id" value="<?= $id ?>"/>
                        <!--<input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก วันที่ซ่อม"       
                               data-provide="datepicker" data-date-format="dd/mm/yyyy"
                               name="input-nameth" id="input-nameth" value="<?= $nameth ?>" readonly/>-->
                        <div class="input-group">
                            <input type="text" class="form-control" id="datetext" readonly/>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="datebtn">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-nameth" class="col-sm-1 control-label">ชื่อ</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก ชื่อ"
                               name="input-nameth" id="input-nameth" value="<?= $nameth ?>"/>
                    </div>
                    <label for="input-nameth" class="col-sm-1 control-label">นามสกุล</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก นามสกุล"
                               name="input-nameth" id="input-nameth" value="<?= $nameth ?>"/>
                    </div>
                    <label for="input-nameth" class="col-sm-1 control-label">เลขบัตร</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก เลขบัตร ประชาชน"
                               name="input-nameth" id="input-nameth" value="<?= $nameth ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-nameeng" class="col-sm-1 control-label">ที่อยู่</label>
                    <div class="col-sm-8">
                        <textarea class="form-control validate[required]"
                                  data-errormessage-value-missing="กรุณากรอก รายละเอียด"
                                  name="input-desc" id="input-desc"></textarea>                
                    </div>
                </div>    
                <div class="form-group">
                    <label for="input-nameeng" class="col-sm-1 control-label">ยี้ห้อ</label>
                    <div class="col-sm-2">
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
                    <label for="input-nameeng" class="col-sm-1 control-label">รุ่น</label>
                    <div class="col-sm-2">
                        <select class="form-control validate[required]" name="combo-model" id="combo-model"
                                data-errormessage-value-missing="กรุณาเลือก รุ่น">
                            <option value="" selected>-- เลือก --</option>                            
                        </select>          
                    </div>
                    <label for="input-nameeng" class="col-sm-1 control-label">เลขเครื่อง</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก เลขเครื่อง"
                               name="input-nameth" id="input-nameth" value="<?= $nameth ?>"/>             
                    </div>
                    <label for="input-nameeng" class="col-sm-1 control-label">สี</label>
                    <div class="col-sm-2">
                        <select class="form-control validate[required]" name="combo-color" id="combo-color"
                                data-errormessage-value-missing="กรุณาเลือก สี">
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
                        <a href="index.php?page=list-in_repair" class="btn btn-warning">
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
        // ########## combo brand , combo model ##########
        $('#combo-brand').on('change', function(event) {
            $.post('../action/model.php?method=get_model_by_bra_id', {bra_id: this.value}, function(data) {
                $('#combo-model').empty();
                $.each(data, function(index, value) {
                    $('#combo-model').append('<option value="' + value.mod_id + '">' + value.mod_nameth + '</option>');
                });
            }, 'json');
        });
        // ########## combo brand , combo model ##########
        var valid = $('#frm-in_repair').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                console.log('status :' + status);
                if (status == true) {
                    post_form('frm-in_repair', '../action/in_repair.php?method=create');
                }
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>

