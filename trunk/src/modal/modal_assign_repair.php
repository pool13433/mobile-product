<div class="modal fade" id="modal-repair<?= $data['inrep_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">มอบหมายงาน</h4>
            </div>
            <div class="modal-body">      
                <form class="form-horizontal" name="frm-assign_repair_<?= $data['inrep_id'] ?>" id="frm-assign_repair_<?= $data['inrep_id'] ?>">
                    <div class="form-group">
                        <label for="input-employee" class="col-sm-5 control-label">ชื่อพนักงานซ่อม</label>
                        <div class="col-sm-6">
                            <input type="hidden" name="input-repair_id" value="<?= $data['inrep_id'] ?>"/>
                            <input type="hidden" name="input-repair_repairers" value="<?= $data['rep_id'] ?>"/>
                            <select class="form-control validate[required]" 
                                    data-errormessage-value-missing="กรุณากรอก ชื่อไทย"
                                    name="combo-employee" id="combo-employee">  
                                <option value="" selected>-- เลือก --</option>
                                <?php
                                /*
                                 * '1' => 'พนักงานร้าน',         '2' => 'พนักงานซ่อม',         '3' => 'เจ้าของร้าน',         '4' => 'ลูกค้า',
                                 */
                                $sql_employee = "SELECT * FROM person WHERE per_status = 2";
                                $query_employee = mysql_query($sql_employee) or die(mysql_error());
                                while ($data_employee = mysql_fetch_array($query_employee)):
                                    ?>                                    
                                    <?php if ($data['rep_repairers'] == $data_employee['per_id']): ?>
                                        <option value="<?= $data_employee['per_id'] ?>" selected><?= $data_employee['per_fname'] . "   " . $data_employee['per_lname'] ?></option>
                                    <?php else: ?>
                                        <option value="<?= $data_employee['per_id'] ?>"><?= $data_employee['per_fname'] . "   " . $data_employee['per_lname'] ?></option>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="input-employee" class="col-sm-5 control-label">วันที่เริ่มซ่อม (ประมาณการ)</label>
                        <div class="col-sm-4 input-append date">
                            <div class="input-group">
                                <input type="text" class="form-control validate[required]" value="<?= change_dateYMD_TO_DMY($data['rep_suppose_startdate']) ?>"
                                       data-errormessage-value-missing="กรุณากรอก วันที่ซ่อม"
                                       name="input-createdate" id="datetext_1<?= $data['inrep_id'] ?>" readonly/>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="datebtn_1<?= $data['inrep_id'] ?>">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-employee" class="col-sm-5 control-label">วันที่สิ้นสุดซ่อม (ประมาณการ)</label>
                        <div class="col-sm-4 input-append date">
                            <div class="input-group">
                                <input type="text" class="form-control validate[required]" value="<?= change_dateYMD_TO_DMY($data['rep_suppose_enddate']) ?>"
                                       data-errormessage-value-missing="กรุณากรอก วันที่สิ้นสุดซ่อม"
                                       name="input-enddate" id="datetext_2<?= $data['inrep_id'] ?>" readonly/>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="datebtn_2<?= $data['inrep_id'] ?>">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">                    
                <button type="submit" class="btn btn-primary" onclick="javascript:$('#frm-assign_repair_<?= $data['inrep_id'] ?>').submit()">
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
        var valid = $('#frm-assign_repair_' + modal_id).validationEngine('attach', {
            promptPosition: "centerLeft:30",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status) {
                    $.post('../action/repairers.php?method=assign_repair',
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