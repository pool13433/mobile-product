<!-- Modal -->
<div class="modal fade" id="modal-appraisers<?= $data['inrep_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">หน้าฟอร์มประเมินราคา ค่าซ่อม</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="frm-appraisers_repair_<?= $data['inrep_id'] ?>" id="frm-appraisers_repair_<?= $data['inrep_id'] ?>">                                            
                    <div class="form-group">
                        <label for="input-employee" class="col-sm-4 control-label">สถานะการประเมิน</label>
                        <div class="col-sm-8 inline">
                            <input type="hidden" name="id" value="<?= $data['inrep_id'] ?>"/>
                            <input type="radio" name="status" value="1" class="validate[required]"
                                   data-errormessage-value-missing="กรุณากรอก สถานะการประเมิน"/> รับซ่อม
                            <input type="radio" name="status" value="2" class="validate[required]"
                                   data-errormessage-value-missing="กรุณากรอก สถานะการประเมิน"/> ไม่รับซ่อม
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-employee" class="col-sm-4 control-label">ราคาซ่อม</label>
                        <div class="col-sm-4">
                            <input type="text" name="price"  class="form-control validate[required,custom[number]]"
                                   data-errormessage-value-missing="กรุณากรอก ราคาซ่อม"
                                   data-errormessage-custom-error="กรุณากรอก ราคาตัวเลขเท่านั้น"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-employee" class="col-sm-4 control-label">หมายเหตุ</label>
                        <div class="col-sm-8">
                            <textarea class="form-control validate[required]" rows="7" name="remark"                                      
                                      data-errormessage-value-missing="กรุณากรอก หมายเหตุ"/></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">                
                <button type="submit" class="btn btn-primary" onclick="javascript:$('#frm-appraisers_repair_<?= $data['inrep_id'] ?>').submit()">
                    <i class="glyphicon glyphicon-ok-sign"></i> บันทึก
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="glyphicon glyphicon-remove-sign"></i> ปิด
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var modal_id = <?= $data['inrep_id'] ?>;
        var load_date_picker = date_picker_custom(modal_id);
        var valid = $('#frm-appraisers_repair_' + modal_id).validationEngine('attach', {
            promptPosition: "centerLeft:50",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status) {
                    $.post('../action/repair_assign.php?method=update_appraisers',
                            $(form).serialize(),
                            function(data) {
                                if (data.status == 'success') {
                                    showNotification('success', data.title, data.msg, 3);
                                    reloadDelay(2);
                                } else {
                                    showNotification('danger', data.title, data.msg, 3);
                                }
                            }, 'json');
                }
            }
        });
    });

</script>

