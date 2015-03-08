<?php
$pid = '';
$mobile = '';
if (!empty($_GET['pid'])) {
    $pid = $_GET['pid'];
}
if (!empty($_GET['mobile'])) {
    $mobile = $_GET['mobile'];
}
?>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="glyphicon glyphicon-phone"></i> <b>รายการ ไบซ่อมเครื่องมือถือของคุณทั้งหมดในระบบ</b>
            </h4>
            <div class="btn-group pull-right">
                <form class="form-inline" action="index.php?page=list-repair" method="get">
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                        <div class="input-group">
                            <input type="hidden" name="page" value="<?= $_GET['page'] ?>"/>
                            <input type="text" class="form-control" id="pid" name="pid" value="<?= $pid ?>"
                                   placeholder="เลขบัตรประชาชน 13 หลัก" maxlength="13">
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="pid" name="mobile" value="<?= $mobile ?>"
                                   placeholder="เบอร์โทรศัพท์มือถือ" maxlength="10">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-success">
                                    <i class="glyphicon glyphicon-search"></i> เริ่มค้นหา
                                </button>
                            </div>
                        </div>                        
                    </div>
                </form>
            </div>
        </div>
        <div class="panel-body">
            <?php
            if (!empty($pid) && !empty($mobile)) {
                include './config/connection.php';
                $sql_preson = " SELECT * FROM person WHERE per_idcard = '$pid' AND per_mobile = '$mobile'";
                $query_person = mysql_query($sql_preson) or die(mysql_error());
                $person = mysql_fetch_assoc($query_person);
                if (!empty($person)) {
                    ?>
                    <form name="frm-person" id="frm-person" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="input-fname" class="col-sm-4 control-label">ชื่อ</label>
                                <div class="col-sm-6">
                                    <input type="hidden" name="input-id" value="<?= $person['per_id'] ?>"/>
                                    <input type="hidden" name="cmd" value="<?= CUSTOMER_STATUS ?>"/>
                                    <input type="text" class="form-control validate[required]" 
                                           data-errormessage-value-missing="กรุณากรอก ชื่อ"
                                           name="input-fname" id="input-fname" value="<?= $person['per_fname'] ?>"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="input-lname" class="col-sm-4 control-label">นามสกุล</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control validate[required]" 
                                           data-errormessage-value-missing="กรุณากรอก นามสกุล"
                                           name="input-lname" id="input-lname" value="<?= $person['per_lname'] ?>"/>
                                </div>
                            </div>                                        
                        </div>                        
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="input-idcard" class="col-sm-4 control-label">รหัสบัตรประชาชน</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control validate[required,maxSize[13],minSize[13]]" readonly
                                           data-errormessage-value-missing="กรุณากรอก รหัสบัตรประชาชน"
                                           data-errormessage-range-underflow="กรุณากรอก รหัสบัตรประชาชน 13 หลัก"
                                           data-errormessage-range-overflow="กรุณากรอก รหัสบัตรประชาชน 13 หลัก"
                                           name="input-idcard" id="input-idcard" value="<?= $person['per_idcard'] ?>" onchange="check_idcard(this)"/>
                                </div>
                            </div>                                        
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="input-mobile" class="col-sm-4 control-label">โทรศัพท์</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control validate[required,custom[phone],minSize[10]]" 
                                           data-errormessage-value-missing="กรุณากรอก โทรศัพท์" maxlength="10"
                                           data-errormessage-range-underflow="กรุณากรอก โทรศัพท์ 10 ตัว"
                                           data-errormessage-custom-error="กรุณากรอก โทรศัพท์ ให้ถูกต้อง"
                                           name="input-mobile" id="input-mobile" value="<?= $person['per_mobile'] ?>"/>
                                </div>
                            </div>  
                            <div class="col-sm-6">
                                <label for="input-email" class="col-sm-4 control-label">อีเมลล์</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control validate[required,custom[email]]" 
                                           data-errormessage-value-missing="กรุณากรอก ยืนยัน อีเมลล์"
                                           data-errormessage-custom-error="กรุณากรอก ยืนยัน อีเมลล์ ให้ถูกต้อง"
                                           name="input-email" id="input-email" value="<?= $person['per_email'] ?>"/>
                                </div>
                            </div>                                        
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="input-address" class="col-sm-2 control-label">ที่อยู่</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control validate[required]" 
                                              data-errormessage-value-missing="กรุณากรอก ที่อยู่"
                                              name="input-address" id="input-address"><?= $person['per_address'] ?></textarea>
                                </div>
                            </div>                                       
                        </div>
                        <div class="form-group">
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-success">
                                    <i class="glyphicon glyphicon-saved"></i> แก้ไขข้อมูลส่วนตัว
                                </button>
                                <a href="index.php" class="btn btn-warning">
                                    <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
                                </a>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <table class="table table-striped table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>วันที่เริ่มนำไปซ่อม</th>
                                <th>วันที่ไปรับของ</th>
                                <th>สถานะการซ่อม</th>
                                <th>ราคาซ่อม</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_repair = "SELECT * FROM repair ir";
                            $sql_repair .= " JOIN person p ON p.per_id = ir.per_id";
                            $sql_repair .= " JOIN repairers r ON r.rep_id = ir.inrep_id";
                            $sql_repair .=" WHERE p.per_idcard = '$pid' ";
                            $sql_repair .= " ORDER BY ir.inrep_id";
                            $query_accessory = mysql_query($sql_repair) or die(mysql_error());
                            $row = 1;
                            while ($data = mysql_fetch_array($query_accessory)):
                                ?>
                                <tr>
                                    <td><?= $data['inrep_code'] ?></td>
                                    <td><?= format_date('d/m/Y', $data['inrep_createdate']) ?></td>
                                    <td><?= format_date('d/m/Y', $data['inrep_getdate']) ?></td>
                                    <td>
                                        <div class="label label-<?= getDataList($data['inrep_status'], listRepairStatusColor()) ?>">
                                            <?= getDataList(intval($data['inrep_status']), listRepairStatus()) ?>
                                        </div>                                
                                    </td>
                                    <td><?= $data['rep_estimate_price'] ?></td>
                                    <td>
                                        <?php if ($data['inrep_status'] == 2) { // รอ ลุกค้า อนุมัติ  ?>
                                            <a class="btn btn-info" onclick="approve_repair(3,<?= $data['inrep_id'] ?>)">
                                                <i class="glyphicon glyphicon-ok-sign"></i> อนุมัติการซ่อม 
                                            </a>      
                                            <a class="btn btn-danger" onclick="approve_repair(4,<?= $data['inrep_id'] ?>)">
                                                <i class="glyphicon glyphicon-remove-sign"></i> ไม่ อนุมัติการซ่อม (ยกเลิกการซ่อม)
                                            </a>   
                                        <?php } else if (intval($data['inrep_status']) != 2 && $data['inrep_status'] != 4) { // 3 = อนัติไปแล้ว ?>
                                            <span class="label label-success"><?= getDataList($data['inrep_status'], listRepairStatus()) ?> กรุณารอ...</span>
                                        <?php } else { ?>
                                            <span class="label label-danger">ท่านยกเลิกไปแล้ว จบงานซ่อม[<?= $data['inrep_status'] ?>]</span>
                                        <?php } ?>
                                    </td>
                                </tr>             
                                <?php
                                $row++;
                            endwhile;
                            ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <h2>
                        <span class="label label-danger">
                            <i class="glyphicon glyphicon-warning-sign"></i> ไม่พบข้อมูล รหัสบัตรประชาชน และ เบอร์โทรศัพท์นี้ในระบบ
                        </span>
                    </h2>
                <?php } ?>
            <?php } else { ?>
                <h2>
                    <span class="label label-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> กรุณากรอกข้อมูล รหัสบัตรประชาชน และ เบอร์โทรศัพท์
                    </span>
                </h2>
            <?php } ?>
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
                    post_form('frm-person', './action/person.php?method=create');
                }
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
    function approve_repair(status, repair_id) {
        var conf = confirm('ยืนยันการเปลี่ยนแปลง สถานะ การซ่อม ใช่ [OK] || ยกเลิก [Cancle]');
        if (conf) {
            $.post('../action/repairers.php?method=update_approve',
                    {
                        repair_id: repair_id,
                        status: status
                    },
            function(data) {
                if (data.status == 'success') {
                    showNotification('success', data.title, data.msg, 3);
                    reloadDelay(2);
                } else {
                    showNotification('danger', data.title, data.msg, 3);
                }
            }, 'json');
            return true;
        }
    }
</script>