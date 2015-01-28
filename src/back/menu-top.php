<?php
if (!isset($_SESSION)) {
    @session_start();
}
$person = '';
$ses_id = '';
$per_fname = '';
$per_lname = '';
$per_status = '';
if (!empty($_SESSION['person'])):
    $person = $_SESSION['person'];
    $ses_id = $person['per_id'];
    $per_fname = $person['per_fname'];
    $per_lname = $person['per_lname'];
    $per_status = $person['per_status'];
endif;
?>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <i class="glyphicon glyphicon-phone"></i> โปรแกรมซ่อมโทรศัพท์
                <i class="glyphicon glyphicon-user"></i> 
                <div class="label label-info">
                    <?= ' ชื่อ :: ' . $per_fname . '   นามสกุล :: ' . $per_lname ?>
                </div>               
                <div class="label label-warning">
                    <?= ' สถานะ :: ' . getDataList($per_status, listPersonStatus()) ?>
                </div>
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#" data-toggle="modal" data-target="#modal-profile">
                        <i class="glyphicon glyphicon-user"></i> ข้อมูลส่นตัว
                    </a>
                </li>
                <li>
                    <a href="#" id="btn-changpassword" data-toggle="modal" data-target="#modal-chang_password">
                        <i class="glyphicon glyphicon-lock"></i>  เปลี่ยนรหัสผ่าน
                    </a>
                </li>
                <li><a href="#" onclick="logout()"><i class="glyphicon glyphicon-log-out"></i> ออกจากระบบ</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
        </div>
    </div>
</div>
