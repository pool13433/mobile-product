<?php
@session_start();
include '../config/connection.php';

$repair_id = '';
$repair_code = '';
$repair_createdate = '';
$fname = '';
$lname = '';
$idcard = '';
$address = '';
$brand = '';
$model = '';
$mobile = '';
$repair_emi = '';
$color = '';

$accessory = '';
$accessory_other = '';

$proble = '';
$proble_other = '';

$repair_remark = '';
$repair_getdate = '';
$per_id = '';

$repair_status = '0';
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM in_repair ir";
    $sql .= " LEFT JOIN person p ON p.per_idcard = ir.per_idcard";
    $sql .= " WHERE inrep_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
    $repair_id = $data['inrep_id'];
    $repair_code = $data['inrep_code'];
    $repair_createdate = $data['inrep_createdate'];
    $fname = $data['per_fname'];
    $lname = $data['per_lname'];
    $idcard = $data['per_idcard'];
    $mobile = $data['per_mobile'];
    $address = $data['per_address'];
    $brand = $data['bra_id'];
    $model = $data['mod_id'];
    $repair_emi = $data['inrep_emi'];
    $color = $data['col_id'];

    $accessory = '';
    $accessory_other = $data['inrep_accessory_other'];

    $proble = '';
    $proble_other = $data['inrep_problem_other'];

    $repair_remark = $data['inrep_remark'];
    $repair_getdate = $data['inrep_getdate'];
    $per_id = '';
}
//############ session ###########
$person = '';
$per_id = '';
$per_fullname = '';
if (!empty($_SESSION['person'])):
    $person = $_SESSION['person'];
    $per_id = $person['per_id'];
    $per_fullname = $person['per_fname'] . '  ' . $person['per_lname'];
endif;
//############ session ###########
//############ gen code ###########
if (empty($repair_code)):
    $sql_gen = "SELECT * FROM in_repair ORDER BY inrep_id DESC LIMIT 0,1";
    $query_gen = mysql_query($sql_gen) or die(mysql_error());
    $result_gen = mysql_fetch_assoc($query_gen);
    $repair_code = 'RP' . Gen_Code($result_gen['inrep_id']);
endif;
//############ gen code ###########
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
                    <label for="input-repair_code" class="col-sm-1 control-label">เลขที่</label>
                    <div class="col-sm-3">
                        <input type="hidden" name="input-id" value="<?= $repair_id ?>"/>
                        <input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก เลขที่ซ่อม"
                               name="input-repair_code" id="input-repair_code" value="<?= $repair_code ?>"/>
                    </div>
                    <label  class="col-sm-3 control-label"></label>
                    <label for="input-createdate" class="col-sm-2 control-label">วันที่ซ่อม</label>
                    <div class="col-sm-2 input-append date">
                        <div class="input-group">
                            <input type="text" class="form-control validate[required]" value="<?= change_dateYMD_TO_DMY($repair_createdate) ?>"
                                   data-errormessage-value-missing="กรุณากรอก วันที่ซ่อม"
                                   name="input-createdate" id="datetext_1" readonly/>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="datebtn_1">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-fname" class="col-sm-1 control-label">ชื่อ</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก ชื่อ"
                               name="input-fname" id="input-fname" value="<?= $fname ?>"/>
                    </div>
                    <label for="input-lname" class="col-sm-1 control-label">นามสกุล</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก นามสกุล"
                               name="input-lname" id="input-lname" value="<?= $lname ?>"/>
                    </div>
                    <label for="input-idcard" class="col-sm-1 control-label">เลขบัตร</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก เลขบัตร ประชาชน"
                               name="input-idcard" id="input-idcard" value="<?= $idcard ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-address" class="col-sm-1 control-label">ที่อยู่</label>
                    <div class="col-sm-6">
                        <textarea class="form-control validate[required]"
                                  data-errormessage-value-missing="กรุณากรอก รายละเอียด"
                                  name="input-address" id="input-address"><?= $address ?></textarea>                
                    </div>
                    <label for="input-mobile" class="col-sm-2 control-label">โทรศัพท์</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก โทรศัพท์"
                               name="input-mobile" id="input-mobile" value="<?= $mobile ?>"/>
                    </div>
                </div>    
                <div class="form-group">
                    <label for="input-brand" class="col-sm-1 control-label">ยี้ห้อ</label>
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
                    <label for="input-model" class="col-sm-1 control-label">รุ่น</label>
                    <div class="col-sm-2">
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
                    <label for="input-emi" class="col-sm-1 control-label">เลขเครื่อง</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control validate[required]" 
                               data-errormessage-value-missing="กรุณากรอก เลขเครื่อง"
                               name="input-emi" id="input-emi" value="<?= $repair_emi ?>"/>             
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
                <div class="form-group" id="box_accessory">
                    <label for="input-accessory" class="col-sm-2 control-label">อุปกรณ์เสริม</label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <?php
                            $sql_accessory = "SELECT * FROM accessory ";
                            $query_accessory = mysql_query($sql_accessory) or die(mysql_error());
                            while ($data_access = mysql_fetch_array($query_accessory)) :
                                ?>
                                <label>
                                    <input type="checkbox" value="<?= $data_access['acc_id'] ?>" name="checkbox-accessory[]">
                                    <?= $data_access['acc_name'] ?>
                                </label>
                            <?php endwhile; ?>
                            <label>
                                <input type="checkbox" value="0" name="checkbox-accessory[]">
                                อื่น ๆ ระบุ                                            
                            </label>
                            <input type="text" name="input-accessory_other" value="<?=$accessory_other?>"/>
                        </div>

                    </div>
                </div>
                <div class="form-group" id="box_problem">
                    <label for="input-nameeng" class="col-sm-2 control-label">อาการ/สาเหตุ</label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <?php
                            $sql_problem = "SELECT * FROM problem ";
                            $query_problem = mysql_query($sql_problem) or die(mysql_error());
                            while ($data_problem = mysql_fetch_array($query_problem)) :
                                ?>
                                <label>
                                    <input type="checkbox" value="<?= $data_problem['prob_id'] ?>" name="checkbox-problem[]">
                                    <?= $data_problem['prob_name'] ?>
                                </label>
                            <?php endwhile; ?>
                            <label>
                                <input type="checkbox" value="0" name="checkbox-problem[]">
                                อื่น ๆ ระบุ                                            
                            </label>
                            <input type="text" name="input-problem_other" value="<?=$proble_other?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-remark" class="col-sm-2 control-label">หมายเหตุตำหนิเครื่อง</label>
                    <div class="col-sm-9">
                        <textarea class="form-control validate[required]" 
                                  data-errormessage-value-missing="กรุณาเลือก หมายเหตุตำหนิเครื่อง"
                                  name="input-remark" ><?= $repair_remark ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-getdate" class="col-sm-2 control-label">วันที่มารับเครื่อง</label>
                    <div class="col-sm-2 input-append date">
                        <div class="input-group">
                            <input type="text" class="form-control validate[required]" value="<?= change_dateYMD_TO_DMY($repair_getdate) ?>"
                                   data-errormessage-value-missing="กรุณาเลือก วันที่มารับเครื่อง"
                                   name="input-getdate" id="datetext_2" readonly/>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="datebtn_2">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                    <label  class="col-sm-2 control-label"></label>
                    <label for="input-per_fullname" class="col-sm-2 control-label">เจ้าหน้าที่รับซ่อม</label>
                    <div class="col-sm-3">
                        <input type="hidden" name="input-per_id" value="<?= $per_id ?>"/>
                        <input type="text" class="form-control" readonly
                               name="input-per_fullname" id="input-per_fullname" value="<?= $per_fullname ?>"/>
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
        var repair_id = $(':input[name=input-id]').val();
        console.log('repair_id :==' + repair_id);
        //########### checkbox accessory #################
        var length_accessory = $('#box_accessory').find(':checkbox').length;
        //console.log('length_accessory :==' + length_accessory);
        $('#box_accessory').find(':checkbox').each(function(index, object) {
            //console.log('index :==' + index);
            //console.log('object :==' + $(object).val());
            var accessory_id = $(object).val();
            $.post('../action/in_repair.php?method=get_accessory_is_check',
                    {
                        repair_id: repair_id,
                        accessory_id: accessory_id
                    }, function(data) {
                        console.log('data.status :=='+data.status);
                if (data.status) {
                    $(object).prop('checked', true);
                }
            }, 'json');
        });
        //########### checkbox accessory #################
        
        //########### checkbox problem #################
        var length_accessory = $('#box_accessory').find(':checkbox').length;
        //console.log('length_accessory :==' + length_accessory);
        $('#box_problem').find(':checkbox').each(function(index, object) {
            //console.log('index :==' + index);
            //console.log('object :==' + $(object).val());
            var accessory_id = $(object).val();
            $.post('../action/in_repair.php?method=get_problem_is_check',
                    {
                        repair_id: repair_id,
                        problem_id: accessory_id
                    }, function(data) {
                        console.log('data.status :=='+data.status);
                if (data.status) {
                    $(object).prop('checked', true);
                }
            }, 'json');
        });
        //########### checkbox problem #################
        
        var valid = $('#frm-in_repair').validationEngine('attach', {
            promptPosition: "centerLeft:50",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status) {
                    post_form('frm-in_repair', '../action/in_repair.php?method=create');
                }
            }});
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>

