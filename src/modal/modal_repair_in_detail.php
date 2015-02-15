<!-- Modal -->
<div class="modal fade" id="modal-view<?= $data['inrep_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">รายละเอียดรหัสใบซ่อม <?= $data['inrep_code'] ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">                    
                    <label class="col-lg-3" style="text-align: right">ชื่อ</label>
                    <label class="col-lg-3"><h4><span class="label label-info"><?= $data['per_fname'] ?></span></h4></label>
                    <label class="col-lg-3" style="text-align: right">นามสกุล</label>
                    <label class="col-lg-3"><h4><span class="label label-info"><?= $data['per_lname'] ?></span></h4></label>
                </div>
                <div class="row">                    
                    <label class="col-lg-3" style="text-align: right">วันมาซ่อม</label>
                    <label class="col-lg-3"><h4><span class="label label-info"><?= format_date('d/m/Y', $data['inrep_createdate']) ?></span></h4></label>
                    <label class="col-lg-3" style="text-align: right">วันมารับของ</label>
                    <label class="col-lg-3"><h4><span class="label label-info"><?= format_date('d/m/Y', $data['inrep_getdate']) ?></span></h4></label>
                </div>
                <div class="row">                    
                    <label class="col-lg-3" style="text-align: right">ปัญหา</label>
                    <div class="col-lg-9">
                        <?php
                        $sql_problem = "SELECT * FROM in_repair_problem ir_p";
                        $sql_problem .= " LEFT JOIN problem p ON p.prob_id = ir_p.prob_id";
                        $sql_problem .= " WHERE ir_p.inrep_id = " . $data['inrep_id'];
                        $query_problem = mysql_query($sql_problem) or die(mysql_error());
                        while ($obj = mysql_fetch_array($query_problem)) {
                            if (!empty($obj['prob_name'])) {
                                echo '<h4><span class="label label-info"><i class="glyphicon glyphicon-screenshot"></i> ' . $obj['prob_name'] . '</span></h4>';
                            }
                        }
                        ?>                        
                    </div>
                </div>
                <div class="row">                    
                    <label class="col-lg-3" style="text-align: right">ประเมิน</label>
                    <label class="col-lg-3"><h4><span class="label label-success"><?= getDataList($data['rep_estimate_status'], listRepairAppraisers()) ?></span></h4></label>
                    <label class="col-lg-3" style="text-align: right">ราคา ซ่อม</label>
                    <label class="col-lg-3"><h4><span class="label label-success"><?= $data['rep_estimate_price'] ?></span></h4></label>
                </div>
                <div class="row">                    
                    <label class="col-lg-3" style="text-align: right">เหตุผล</label>
                    <div class="col-lg-7">
                        <div class="well"><?= $data['rep_estimate_remark'] ?></div>
                    </div>
                </div>               
                <div class="row">                    
                    <label class="col-lg-3" style="text-align: right">สถานะการซ่อม ปัจจุบัน</label>
                    <label class="col-lg-9"><h4><span class="label label-<?= getDataList($data['inrep_status'], listRepairStatusColor()) ?>"><?= getDataList($data['inrep_status'], listRepairStatus()) ?></span></h4></label>
                </div>
                <div class="row">                    
                    <label class="col-lg-3" style="text-align: right">หมายเหตุ</label>
                    <label class="col-lg-3"><h4><span class="label label-<?= getDataList($data['inrep_status'], listRepairStatusColor()) ?>"><?= $data['rep_status_remark'] ?></span></h4></label>
                </div>
                <div class="row">                    
                    <label class="col-lg-3" style="text-align: right">วันที่แก้ไข</label>
                    <label class="col-lg-3"><h4><span class="label label-warning"><?= format_date('d/m/Y', $data['inrep_updatedate']) ?></span></h4></label>
                    <label class="col-lg-3" style="text-align: right">ผู้แก้ไข</label>
                    <label class="col-lg-3"><h4><span class="label label-warning"><?= $data['updateby'] ?></span></h4></label>
                </div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-primary" href="../back/pdf-repair-in.php?repair_id=<?=$data['inrep_id']?>" target="_blank">
                    <i class="glyphicon glyphicon-remove-sign"></i>  พิมพ์ใบซ่อม
                </a>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="glyphicon glyphicon-remove-sign"></i>  ปิด
                </button>
            </div>
        </div>
    </div>
</div>

