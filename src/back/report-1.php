<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-bell"></i> รายงานสรุปการซ่อม
        </h4>        
    </div>
    <div class="panel-body">
        <form class="form-horizontal" name="frm-report-1" id="frm-report-1" method="get" action="pdf-report-1.php">
            <div class="form-group">
                <label for="input-createdate" class="col-sm-2 control-label">วันที่เริ่ม</label>
                <div class="col-sm-2 input-append date">
                    <div class="input-group">
                        <input type="text" class="form-control validate[required]"
                               data-errormessage-value-missing="กรุณากรอก วันที่ซ่อม"
                               name="start_date" id="datetext_1" readonly/>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="datebtn_1">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </button>
                        </span>
                    </div>
                </div>
                <label for="input-createdate" class="col-sm-2 control-label">วันที่สิ้นสุด</label>
                <div class="col-sm-2 input-append date">
                    <div class="input-group">
                        <input type="text" class="form-control validate[required]"
                               data-errormessage-value-missing="กรุณากรอก วันที่ซ่อม"
                               name="end_date" id="datetext_2" readonly/>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="datebtn_2">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>    
            <div class="form-group">
                <label for="input-createdate" class="col-sm-2 control-label">วันที่เริ่ม</label>
                <div class="col-sm-10">
                    <label class="radio-inline"><input type="radio" name="option" value="1">วันที่มาให้ร้านซ่อม</label>
                    <label class="radio-inline"><input type="radio" name="option" value="2">วันที่มารับของ</label>
                    <label class="radio-inline"><input type="radio" name="option" value="3">วันที่เริ่มซ่อม</label>
                    <label class="radio-inline"><input type="radio" name="option" value="4">วันที่สิ้นสุดซ่อม</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">
                        <a href="" target="_blank"><i class="glyphicon glyphicon-upload"></i> ออกรายงาน</a>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

