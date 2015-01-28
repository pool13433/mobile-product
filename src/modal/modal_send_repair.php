<form class="form-horizontal" name="frm-send_repair_<?= $data['inrep_id'] ?>" id="frm-assign_repair">
    <div class="modal fade" id="modal-send<?= $data['inrep_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">มอบหมายงาน</h4>
                </div>
                <div class="modal-body">                
                    <div class="form-group">
                        <label for="input-employee" class="col-sm-3 control-label">ชื่อพนักงานซ่อม</label>
                        <div class="col-sm-6">
                            <input type="hidden" name="input-repair_id_<?= $data['inrep_id'] ?>" value="<?= $data['inrep_id'] ?>"/>                            
                            <select class="form-control" name="combo-repair_status_<?= $data['inrep_id'] ?>">
                                <option value="2">ซ่อมสำเร็จ</option>
                                <option value="3">เกิดปัญหาในการซ่อม</option>
                            </select>
                        </div>
                    </div>       
                    <div class="form-group">
                        <label for="input-employee" class="col-sm-3 control-label">หมายเหตุ</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="repair_status_remark_<?= $data['inrep_id'] ?>"></textarea>
                        </div>
                    </div>   
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="btn btn-primary" onclick="send_repair(<?= $data['inrep_id'] ?>)">
                        <i class="glyphicon glyphicon-ok-sign"></i> บันทึก
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="glyphicon glyphicon-remove-sign"></i> ปิด
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    var send_repair = function(modal_id) {
        var repair_id = $(':input[name=input-repair_id_' + modal_id + ']').val();
        var repair_status = $('select[name=combo-repair_status_' + modal_id + ']').val();
        var repair_status_remark = $('textarea[name=repair_status_remark_' + modal_id + ']').val();
        console.log('repair_id ::==' + repair_id);
        console.log('repair_status_remark ::==' + repair_status_remark);
        console.log('repair_status ::==' + repair_status);
        if (repair_status === '') {
            showNotification('danger', 'ข้อความเตือนจากระบบ', 'กรุณาเลือก สถานะการซ่อม', 2);
        } else {
            if (repair_status === '2' || (repair_status === '3' && repair_status_remark != '')) { // ถ้าเลือก เกิดปัญหา ใส่หมายเหตุด้วย
                $.post('../action/repair.php?method=send_repair',
                        {
                            repair_id: repair_id,
                            repair_status: repair_status,
                            repair_status_remark: repair_status_remark
                        },
                function(data) {
                    if (data.status == 'success') {
                        showNotification('success', data.title, data.msg, 3);
                        reloadDelay(2);
                    } else {
                        showNotification('danger', data.title, data.msg, 3);
                    }
                }, 'json');
            } else {
                showNotification('danger', 'ข้อความเตือนจากระบบ', 'ถ้าเลือก เกิดปัญหา ใส่หมายเหตุด้วย', 2);
            }
        }
    }
</script>