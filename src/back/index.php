<!DOCTYPE html>
<html>
    <head>
        <title>ระบบ ซ่อมมือถือ</title>
        <meta charset="UTF-8">                 
        <script language="JavaScript" src="../../lib/bootstrap-table-master/docs/assets/js/jquery.min.js" type="text/javascript"></script>        

        <!-- boostarp -->
        <link rel="stylesheet" type="text/css" href="../../lib/bootstrap-table-master/docs/assets/bootstrap/css/bootstrap.min.css">
        <script language="JavaScript" src="../../lib/bootstrap-table-master/docs/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- boostarp -->

        <!-- pnotify -->
        <link rel="stylesheet" type="text/css" href="../../css/pnotify.custom.min.css">      
        <script language="JavaScript" src="../../js/pnotify.custom.min.js"></script>
        <!-- pnotify -->

        <!-- validate enging-->     
        <link rel="stylesheet" type="text/css" href="../../lib/validationengine/css/validationEngine.jquery.css"/>
        <script type="text/javascript" src="../../lib/validationengine/js/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="../../lib/validationengine/js/languages/jquery.validationEngine-en.js"></script>
        <!-- validate enging-->

        <!-- dataatble -->
        <link rel="stylesheet" type="text/css" href="../../lib/bootstrap-table-master/docs/dist/bootstrap-table.min.css"/>
        <script type="text/javascript" src="../../lib/bootstrap-table-master/docs/dist/bootstrap-table.min.js"></script>
        <script type="text/javascript" src="../../lib/bootstrap-table-master/docs/dist/extensions/export/bootstrap-table-export.min.js"></script>
        <!-- dataatble -->

        <!-- datepicker-->
        <link rel="stylesheet" type="text/css" href="../../lib/bootstrap-datepicker/css/datepicker.css"/>
        <script type="text/javascript" src="../../lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <!-- datepicker-->

        <link rel="stylesheet" type="text/css" href="../../css/style.css">
        <script language="JavaScript" src="../../js/script.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
        if (!isset($_SESSION)) {
            @ob_start();
            @session_start();
        }
        ?>
        <?php include '../config/extension.php'; ?>
        <?php include './menu-top.php'; ?>        
        <div class="container-fluid">
            <div class="row">
                <?php include './menu-left.php'; ?>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <?php
                    // ตรวจสอบ login 
                    if (empty($_SESSION)):  // login fail
                        header('Location: http://localhost/mobile/src/');
                        exit();
                    else: // login OK
                        // ตรวจสอบ ค่า ว่ามีการส่งค่ามาหรือเปล่า
                        if (!empty($_GET)) {  // มีค่า
                            $page = $_GET['page'] . '.php';
                            if (file_exists($page)) {
                                include $page;
                            } else {
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    ไม่พบ หน้าเว็บ ที่เรียกหา Error 404
                                </div>
                                <?php
                            }
                            include '../modal/modal_profile.php';
                            include '../modal/modal_chang_password.php';
                        } else {
                            include './home.php';
                        }
                    endif;
                    ?>
                </div>
            </div>            
        </div>
    </body>
</html>

