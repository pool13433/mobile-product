<!-- Modal -->
<div class="modal fade" id="modal-chang_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal" name="frm-password" id="frm-password">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">เปลี่ยนรหัสผ่าน</h4>
                </div>
                <div class="modal-body">                
                    <div class="form-group">
                        <label for="input-password_old" class="col-sm-4 control-label">รหัสผ่านเก่า</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control validate[required]" 
                                   data-errormessage-value-missing="กรุณากรอก password เก่า"
                                   name="input-password_old" id="input-password_old" onchange="checkpassword_old()">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-password_new" class="col-sm-4 control-label">รหัสผ่านใหม่</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control validate[required]" 
                                   data-errormessage-value-missing="กรุณากรอก password ใหม่"
                                   name="input-password_new" id="input-password_new">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-password_renew" class="col-sm-4 control-label">รหัสผ่านใหม่ อีกครั้ง</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control validate[required,equals[input-password_new]]" 
                                   data-errormessage-value-missing="กรุณากรอก password ใหม่ อีกครั้ง"
                                   data-errormessage-pattern-mismatch="กรุณากรอกข้อมูล รหัสผ่านให้ตรงกัน"
                                   name="input-password_renew" id="input-password_renew">
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">                
                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-lock"></i>เปลี่ยนรหัสผ่าน</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#btn-changpassword').on('click', function() {
            $('#frm-password').get(0).reset();
        });
        var valid = $('#frm-password').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                console.log('status :' + status);
                if (status == true) {
                    updatepassword_new();
                }
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
    function checkpassword_old() {
        $.post('../action/person.php?method=checkpassword_old', {password_old: $('#input-password_old').val()}, function(data) {
            if (data.status == 'success') {
                showNotification('success', data.title, data.msg, 2);
                //$('#modal-chang_password').modal('hide');
            } else {
                showNotification('danger', data.title, data.msg, 2);
            }
        }, "json");
    }
    function updatepassword_new() {
        var password_old = $('#input-password_old').val();
        var password_new = $('#input-password_new').val();
        $.post('../action/person.php?method=updatepassword_new', {
            password_old: password_old,
            password_new: password_new,
        }, function(data) {
            if (data.status == 'success') {
                showNotification('success', data.title, data.msg, 2);
                $('#modal-chang_password').modal('hide');
            } else {
                showNotification('danger', data.title, data.msg, 2);
            }
        }, "json");
    }
</script>