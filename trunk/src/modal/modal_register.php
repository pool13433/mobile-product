<!-- Modal -->
<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal" name="frm-register" id="frm-register">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="glyphicon glyphicon-user"></i>ลงทะเบียนเข้าใช้งานระบบ</h4>
                </div>
                <div class="modal-body">                
                    <div class="form-group">
                        <label for="input-username" class="col-sm-2 control-label">username</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control validate[required]" 
                                   data-errormessage-value-missing="กรุณากรอก username"
                                   name="input-username" id="input-username"/>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label for="input-password" class="col-sm-2 control-label">รหัสผ่าน</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control validate[required]" 
                                   data-errormessage-value-missing="กรุณากรอก รหัสผ่าน"
                                   name="input-password_1" id="input-password_1"/>
                        </div>
                        <label for="input-password_2" class="col-sm-3 control-label">ยืนยัน รหัสผ่านอีกครั้ง</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control validate[required,equals[input-password_1]]" 
                                   data-errormessage-value-missing="กรุณากรอก รหัสผ่านอีกครั้ง"
                                   data-errormessage-pattern-mismatch ="กรุณากรอก รหัสผ่านให้ตรงกัน"
                                   name="input-password_2" id="input-password_2"/>
                        </div>
                    </div>   
                    <hr/>
                    <div class="form-group">
                        <label for="input-fname" class="col-sm-2 control-label">ชื่อ</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control validate[required]" 
                                   data-errormessage-value-missing="กรุณากรอก ชื่อไทย"
                                   name="input-fname" id="input-fname"/>
                        </div>
                        <label for="input-lname" class="col-sm-2 control-label">นามสกุล</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control validate[required]" 
                                   data-errormessage-value-missing="กรุณากรอก ชื่อไทย"
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
                                   name="input-idcard" id="input-idcard"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="input-address" class="col-sm-2 control-label">ที่อยู่</label>
                        <div class="col-sm-8">
                            <textarea class="form-control validate[required]" 
                                      data-errormessage-value-missing="กรุณากรอก ที่อยู่"
                                      name="input-address" id="input-address" ></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-mobile" class="col-sm-2 control-label">โทรศัพท์</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control validate[required,custom[phone],minSize[10]]" 
                                   data-errormessage-value-missing="กรุณากรอก โทรศัพท์"
                                   data-errormessage-range-underflow="กรุณากรอก โทรศัพท์ 10 ให้ครบ"
                                   data-errormessage-custom-error ="กรุณากรอก โทรศัพท์ เป็นตัวเลขเท่านั้น"
                                   name="input-mobile" id="input-mobile"/>
                        </div>
                        <label for="input-email" class="col-sm-2 control-label">อีเมลล์</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control validate[required,custom[email]]" 
                                   data-errormessage-value-missing="กรุณากรอก อีเมลล์"
                                   data-errormessage-custom-error ="กรุณากรอก อีเมลล์ ให้ถูกต้อง"
                                   name="input-email" id="input-email"/>
                        </div>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="glyphicon glyphicon-ok-circle"></i> ลงทะเบียน                        
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="glyphicon glyphicon-remove-circle"></i> ปิด                   
                    </button>                    
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var valid = $('#frm-register').validationEngine('attach', {
            promptPosition: "centerRight:-20",
            scroll: false,
            onValidationComplete: function(form, status) {                
                if (status) {
                    post_form('frm-register', 'action/person.php?method=register');
                }
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>