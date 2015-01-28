<?php
include '../config/connection.php';
$id = '';
$fname = '';
$lname = '';
$username = '';
$password = '';
$password_confirm = '';
$idcard = '';
$address = '';
$mobile = '';
$email = '';
$status = '';
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM person WHERE per_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
    $id = $data['per_id'];
    $fname = $data['per_fname'];
    $lname = $data['per_lname'];
    $username = $data['per_username'];
    $password = $data['per_password'];
    $idcard = $data['per_idcard'];
    $address = $data['per_address'];
    $mobile = $data['per_mobile'];
    $email = $data['per_email'];
    $status = $data['per_status'];
}
?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-bell"></i> ผู้ใช้งาน
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=list-person" class="btn btn-warning">
                <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
            </a>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <form class="form-horizontal" name="frm-person" id="frm-person">
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="input-fname" class="col-sm-4 control-label">ชื่อ</label>
                        <div class="col-sm-6">
                            <input type="hidden" name="input-id" value="<?= $id ?>"/>
                            <input type="text" class="form-control validate[required]" 
                                   data-errormessage-value-missing="กรุณากรอก ชื่อ"
                                   name="input-fname" id="input-fname" value="<?= $fname ?>"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="input-lname" class="col-sm-4 control-label">นามสกุล</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control validate[required]" 
                                   data-errormessage-value-missing="กรุณากรอก นามสกุล"
                                   name="input-lname" id="input-lname" value="<?= $lname ?>"/>
                        </div>
                    </div>                                        
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="input-username" class="col-sm-4 control-label">username</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control validate[required]" 
                                   data-errormessage-value-missing="กรุณากรอก username"
                                   name="input-username" id="input-username" value="<?= $username ?>"/>
                        </div>
                    </div>                                        
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="input-password" class="col-sm-4 control-label">password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control validate[required]" 
                                   data-errormessage-value-missing="กรุณากรอก password"
                                   name="input-password" id="input-password" value="<?= $password ?>"/>
                        </div>
                    </div>  
                    <div class="col-sm-6">
                        <label for="input-password_re" class="col-sm-4 control-label">ยืนยัน password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control validate[required,equals[input-password]]" 
                                   data-errormessage-value-missing="กรุณากรอก ยืนยัน password"
                                   data-errormessage-pattern-mismatch="กรุณากรอก password ให้ตรงกัน"
                                   name="input-password_re" id="input-password_re" value="<?= $password_confirm ?>"/>
                        </div>
                    </div>                                        
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="input-idcard" class="col-sm-4 control-label">รหัสบัตรประชาชน</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control validate[required,maxSize[13],minSize[13]]" 
                                   data-errormessage-value-missing="กรุณากรอก รหัสบัตรประชาชน"
                                   data-errormessage-range-underflow="กรุณากรอก รหัสบัตรประชาชน 13 หลัก"
                                   data-errormessage-range-overflow="กรุณากรอก รหัสบัตรประชาชน 13 หลัก"
                                   name="input-idcard" id="input-idcard" value="<?= $idcard ?>" onchange="check_idcard(this)"/>
                        </div>
                    </div>                                        
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="input-mobile" class="col-sm-4 control-label">โทรศัพท์</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control validate[required,custom[phone],minSize[10]]" 
                                   data-errormessage-value-missing="กรุณากรอก โทรศัพท์"
                                   data-errormessage-range-underflow="กรุณากรอก โทรศัพท์ 10 ตัวอักษรขึ้นไป"
                                   data-errormessage-custom-error="กรุณากรอก โทรศัพท์ ให้ถูกต้อง"
                                   name="input-mobile" id="input-mobile" value="<?= $mobile ?>"/>
                        </div>
                    </div>  
                    <div class="col-sm-6">
                        <label for="input-email" class="col-sm-4 control-label">อีเมลล์</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control validate[required,custom[email]]" 
                                   data-errormessage-value-missing="กรุณากรอก ยืนยัน อีเมลล์"
                                   data-errormessage-custom-error="กรุณากรอก ยืนยัน อีเมลล์ ให้ถูกต้อง"
                                   name="input-email" id="input-email" value="<?= $email ?>"/>
                        </div>
                    </div>                                        
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="input-address" class="col-sm-2 control-label">ที่อยู่</label>
                        <div class="col-sm-8">
                            <textarea class="form-control validate[required]" 
                                      data-errormessage-value-missing="กรุณากรอก ที่อยู่"
                                      name="input-address" id="input-address"><?= $address ?></textarea>
                        </div>
                    </div>                                       
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="input-address" class="col-sm-2 control-label">ที่อยู่</label>
                        <div class="col-sm-2">
                            <?php include '../config/combo-person_status.php'; ?>
                        </div>
                    </div>                                       
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">
                            <i class="glyphicon glyphicon-saved"></i> บันทึก
                        </button>
                        <a href="index.php?page=list-person" class="btn btn-warning">
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
        var valid = $('#frm-person').validationEngine('attach', {
            promptPosition: "centerLeft:50",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status) {
                    post_form('frm-person', '../action/person.php?method=create');
                }
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>