<?php

session_start();
include '../config/extension.php';
include '../config/connection.php';

if (!empty($_SESSION['person'])) {
    $person = $_SESSION['person'];
}
$url = '';
switch ($_GET['method']) {
    case 'login':
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM person ";
        $sql .= " WHERE per_username = '$username' ";
        $sql .= " AND per_password = '$password'";
        //echo 'sql :'.$sql;
        $query = mysql_query($sql) or die(mysql_error());
        $row = mysql_num_rows($query);
        if ($row > 0) {
            $url = '';
            $person = mysql_fetch_assoc($query);
            $_SESSION['person'] = $person;
            switch ($person['per_status']) {
                case 0: // GENERAL USER
                    $url = 'front/index.php';
                    break;
                case 1: // ADMIN
                    $url = 'back/index.php';
                    break;
                case 2: // MEMBER
                    break;
                default:
                    break;
            }
            echo returnJson('success', 'information', 'เข้าระบบ สำเร็จ', $url);
        } else {
            echo returnJson('fail', 'error', 'ไม่พบข้อมูลในระบบ sql :' . $sql, '');
        }
        break;
    case 'logout':
        if (!empty($_SESSION)) {
            unset($_SESSION['person']);
        }
        break;
    case 'checkpassword_old':
        $password_old = $_POST['password_old'];
        $username = $person['per_username'];
        $sql_person = "SELECT * FROM person WHERE per_username = '$username'";
        $sql_person .= " AND per_password = '$password_old'";
        $query_person = mysql_query($sql_person) or die(mysql_error());
        $row_person = mysql_num_rows($query_person);
        if ($row_person > 0):
            echo returnJson('success', 'ตรวจสอบรหัสผ่าน', 'กรอกรหัสผ่านเก่าถูกต้อง', '');
        else:
            echo returnJson('fail', 'ตรวจสอบรหัสผ่าน', 'รหัสผ่านเก่าไม่ถูกต้อง', '');
        endif;
        break;

    case 'updatepassword_new':
        $password_old = $_POST['password_old'];
        $password_new = $_POST['password_new'];
        $username = $person['per_username'];
        $per_id = $person['per_id'];
        $sql_password_old = "SELECT * FROM person WHERE per_username = '$username'";
        $sql_password_old .= " AND per_password = '$password_old'";
        $query_password_old = mysql_query($sql_password_old) or die(mysql_error());
        $row_password_old = mysql_num_rows($query_password_old);
        if ($row_password_old > 0) {
            $sql_password_new = " UPDATE `person` SET";
            $sql_password_new .= " `per_password`='$password_new'";
            $sql_password_new .= " WHERE per_id = $per_id";
            $query_password_new = mysql_query($sql_password_new) or die(mysql_error());
            if ($query_password_new) {
                echo returnJson('success', 'แก้ไขรหัสผ่าน', 'แก้ไขรหัสผ่าน สำเร็จ', '');
            } else {
                echo returnJson('fail', 'แก้ไขรหัสผ่าน', 'แก้ไขรหัสผ่าน ไม่สำเร็จ', '');
            }
        } else {
            echo returnJson('fail', 'ตรวจสอบรหัสผ่านเก่า', 'รหัสผ่านเก่าไม่ถูกต้อง', '');
        }
        break;
    case 'create':
        if (!empty($_POST)) {
            $per_id = $person['per_id'];
            $id = $_POST['input-id'];
            $nameth = $_POST['input-nameth'];
            $nameeng = $_POST['input-nameeng'];
            if (empty($_POST['input-id'])) { // UPDATE 
                $sql = " INSERT INTO `color`(";
                $sql .= " `col_nameth`, `col_nameeng`, `col_createdate`, ";
                $sql .= " `col_createby`, `col_updatedate`, `col_updateby`)";
                $sql .= " VALUES (";
                $sql .= " '$nameth','$nameeng',NOW(),";
                $sql .= " $per_id,NOW(),$per_id";
                $sql .= " )";
                $title = 'information';
                $msg = 'เพิ่ม สี ใหม่ สำเร็จ';
            } else { // NEW                               
                $sql = " UPDATE `color` SET ";
                $sql .= " `col_nameth`='$nameth',";
                $sql .= " `col_nameeng`='$nameeng',";
                $sql .= " `col_updatedate`=NOW(),";
                $sql .= " `col_updateby`=$per_id";
                $sql .= " WHERE col_id = $id";
                $title = 'information';
                $msg = 'แก้ไข สี สำเร็จ';
            }
            $query = mysql_query($sql) or die(mysql_error() . 'sql :' . $sql);
            if ($query) {
                echo returnJson('success', $title, $msg, 'index.php?page=list-color');
            } else {
                echo returnJson('danger', $title, $msg, '');
            }
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $query = mysql_query("DELETE FROM person WHERE per_id = $id") or die(mysql_error());
        if ($query) {
            echo returnJson('success', 'information', 'ลบสำเร็จ', '');
        }
        break;
    default:
        break;
}

