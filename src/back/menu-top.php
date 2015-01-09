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
