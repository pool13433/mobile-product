<?php
$person = $_SESSION['person'];
?>
<!-- Modal -->
<div class="modal fade" id="modal-profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">เปลี่ยนข้อมูลส่วนตัว</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="frm-profile" id="frm-profile">   
                    <div class="form-group">
                        <label for="input-fname" class="col-sm-2 control-label">ชื่อ</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control validate[required]" 
                                   data-errormessage-value-missing="กรุณากรอก ชื่อไทย" value="<?= $person['per_fname'] ?>"
                                   name="input-fname" id="input-fname"/>
                        </div>
                        <label for="input-lname" class="col-sm-2 control-label">นามสกุล</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control validate[required]" 
                                   data-errormessage-value-missing="กรุณากรอก นามสกุล" value="<?= $person['per_lname'] ?>"
                                   name="input-lname" id="input-lname"/>
                        </div>
                    </div>         
                    <div class="form-group">
                        <label for="input-idcard" class="col-sm-2 control-label">รหัสบัตรประชาชน</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control validate[required,minSize[13],maxSize[13],custom[integer]]" 
                                   data-errormessage-value-missing="กรุณากรอก รหัสบัตรประชาชน"
                                   data-errormessage-range-overflow="กรุณากรอก รหัสบัตร 13 ตัวอักษร"
                                   data-errormessage-range-underflow="กรุณากรอก รหัสบัตร 13 ตัวอักษร"
                                   data-errormessage-custom-error ="กรุณากรอก รหัสบัตร เป็นตัวเลขเท่านั้น"
                                   name="input-idcard" id="input-idcard" value="<?= $person['per_idcard'] ?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="input-address" class="col-sm-2 control-label">ที่อยู่</label>
                        <div class="col-sm-8">
                            <textarea class="form-control validate[required]" 
                                      data-errormessage-value-missing="กรุณากรอก ที่อยู่"
                                      name="input-address" id="input-address" ><?= $person['per_address'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-mobile" class="col-sm-2 control-label">โทรศัพท์</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control validate[required,custom[phone],minSize[10]]" 
                                   data-errormessage-value-missing="กรุณากรอก โทรศัพท์"
                                   data-errormessage-range-underflow="กรุณากรอก โทรศัพท์ 10 ให้ครบ"
                                   data-errormessage-custom-error ="กรุณากรอก โทรศัพท์ เป็นตัวเลขเท่านั้น"
                                   name="input-mobile" id="input-mobile" value="<?=$person['per_mobile']?>"/>
                        </div>
                        <label for="input-email" class="col-sm-2 control-label">อีเมลล์</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control validate[required,custom[email]]" 
                                   data-errormessage-value-missing="กรุณากรอก อีเมลล์"
                                   data-errormessage-custom-error ="กรุณากรอก อีเมลล์ ให้ถูกต้อง"
                                   name="input-email" id="input-email" value="<?=$person['per_email']?>"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">        
                <button type="submit" class="btn btn-primary" onclick="javascript:$('#frm-profile').submit()">
                    <i class="glyphicon glyphicon-ok-circle"></i> แก้ไขข้อมูล                        
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="glyphicon glyphicon-remove-circle"></i> ปิด                   
                </button>   
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var valid = $('#frm-profile').validationEngine('attach', {
            promptPosition: "centerRight:-20",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status) {
                    post_form('frm-profile', '../action/person.php?method=profile');
                }
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>