<!DOCTYPE html>
<html>
    <head>
        <title>ระบบ ซ่อมมือถือ</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script language="JavaScript" src="../lib/bootstrap-table-master/docs/assets/js/jquery.min.js" type="text/javascript"></script>        
                        
        <!-- boostarp -->
        <link rel="stylesheet" type="text/css" href="../lib/bootstrap-table-master/docs/assets/bootstrap/css/bootstrap.min.css">
        <script language="JavaScript" src="../lib/bootstrap-table-master/docs/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- boostarp -->
        
        <!-- pnotify -->
        <link rel="stylesheet" type="text/css" href="../css/pnotify.custom.min.css">      
        <script language="JavaScript" src="../js/pnotify.custom.min.js"></script>
        <!-- pnotify -->

        <!-- validate enging-->     
        <link rel="stylesheet" type="text/css" href="../lib/validationengine/css/validationEngine.jquery.css"/>
        <script type="text/javascript" src="../lib/validationengine/js/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="../lib/validationengine/js/languages/jquery.validationEngine-en.js"></script>
        <!-- validate enging-->
        
        <!-- dataatble -->
        <link rel="stylesheet" type="text/css" href="../lib/bootstrap-table-master/docs/dist/bootstrap-table.min.css"/>
        <script type="text/javascript" src="../lib/bootstrap-table-master/docs/dist/bootstrap-table.min.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-table-master/docs/dist/extensions/export/bootstrap-table-export.min.js"></script>
        <!-- dataatble -->
        
        
         <link rel="stylesheet" type="text/css" href="../css/style.css">
         <script language="JavaScript" src="../js/script.js" type="text/javascript"></script>
        
    </head>
    <body>
        <?php
        include './config/extension.php';

        // ตรวจสอบ ค่า ว่ามีการส่งค่ามาหรือเปล่า
        if (!empty($_GET)) {  // มีค่า
            $page = $_GET['page'] . '.php';
            if (file_exists($page)) {
                include $page;
            } else {
                echo MsgBox('danger', 'ไม่พบ หน้าเว็บ ที่เรียกหา Error 404');
            }
        } else {
            include MAINPAGE;
        }
        ?>
    </body>
</html>

