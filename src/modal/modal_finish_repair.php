<!-- Modal -->
<div class="modal fade" id="modal-finish<?= $data['inrep_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">ส่งงานลูกค้า</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label class="col-lg-3">เช็คของ</label>
                    <div class="col-lg-9">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ชื่อของที่ติดเครื่องมา</th>
                                    <th>ตรวจสอบของ</th>
                                </tr>
                            </thead>
                            <tbody id="table_accessory<?= $data['inrep_id'] ?>">                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="finish_repair(<?= $data['inrep_id'] ?>)">
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
        var repair_id = <?= $data['inrep_id'] ?>;

    });
    function load_accessory(repair_id) {
        // ################ load accessory in bill repair ############### 
        $.post('../action/accessory.php?method=get_list_accessory',
                {
                    repair_id: repair_id
                }, function(data) {
            var table = $('#table_accessory' + repair_id);
            table.empty();
            $.each(data, function(index, object) {
                var tr = '<tr>';
                tr += '<td><input type="hidden" value="' + object.inrepacc_id + '"/>' + object.acc_name + '</td>';
                tr += '<td><input type="checkbox" value="' + object.acc_id + '"/></td>';
                tr += '</tr>';
                table.append(tr);
            });
        }, 'json');
    }
    // ################ load accessory in bill repair ############### 
    function finish_repair(repair_id) {
        var conf = confirm('ยืนยันการส่งใบซ่อมให้ลถกค้า ใช่ [OK] || ยกเลิก [Cancle]');
        if (conf) {
            // ################## push array is check ##########
            var LIST_ACCESSORY = Array();
            var table_accessory = $('#table_accessory' + repair_id);
            table_accessory.find('tr').each(function(index, tr) {
                var td_1text = $(tr).find('td:eq(0)');
                var textbox_1value = td_1text.find('input[type=hidden]').val();
                var td_2 = $(tr).find('td:eq(1)');
                var checkbox_2 = td_2.find('input[type=checkbox]');
                var checkbox_2value = checkbox_2.val();
                var checkbox_2ischeck = checkbox_2.is(':checked');
                if (checkbox_2ischeck) {
                    LIST_ACCESSORY.push({'acc_id': textbox_1value,'acc_check': '1'});
                } else {
                    LIST_ACCESSORY.push({'acc_id': textbox_1value,'acc_check': '0'});
                }
                //console.log('td_1 ::==' + td_1+' td_2 ::=='+td_2);
                //console.log('checkbox_2ischeck::=='+checkbox_2ischeck);
            });
            // ################## push array is check ##########

            // ################## post ##########
            console.log('LIST_ACCESSORY::==' + LIST_ACCESSORY.length);
            console.log('JSON.stringify(s)' + JSON.stringify(LIST_ACCESSORY));
            // ################## post ##########
            $.post('../action/repairers.php?method=finish_repair',
                    {
                        repair_id: repair_id,
                        accessory: JSON.stringify(LIST_ACCESSORY)
                    }, function(data) {
                showNotification(data.status, data.title, data.msg, 3);
                if (data.status == 'success') {
                    reloadDelay(2);
                }
            }, 'json');
            // ################## post ##########
        }
    }
</script>