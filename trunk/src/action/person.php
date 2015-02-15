<?php

@session_start();
include '../config/extension.php';
include '../config/connection.php';

$person = '';
$ses_id = '';
if (!empty($_SESSION['person'])) {
    $person = $_SESSION['person'];
    $ses_id = $person['per_id'];
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

                default:
                    $url = 'back/index.php';
                    break;
            }
            echo returnJson('success', 'information', 'เข้าระบบ สำเร็จ', $url);
        } else {
            var_dump(mysql_fetch_assoc($query));
            echo returnJson('fail', 'error', 'ไม่พบข้อมูลในระบบ sql :' . $sql, '');
        }
        break;
    case 'register':
        if (!empty($_POST)):
            // ########### variable ##########
            $fname = $_POST['input-fname'];
            $lname = $_POST['input-lname'];
            $username = $_POST['input-username'];
            $password = $_POST['input-password_1'];
            $idcard = $_POST['input-idcard'];
            $address = $_POST['input-address'];
            $mobile = $_POST['input-mobile'];
            $email = $_POST['input-email'];
            // ########### variable ##########

            $sql = " INSERT INTO `person`(";
            $sql .= " `per_fname`, `per_lname`,";
            $sql .= " `per_username`, `per_password`,";
            $sql .= " `per_idcard`, `per_address`,";
            $sql .= " `per_mobile`, `per_email`, ";
            $sql .= " `per_createdate`, `per_createby`, ";
            $sql .= " `per_updatedate`, `per_updateby`,";
            $sql .=" `per_status`) VALUES (";
            $sql .= " '$fname','$lname',";
            $sql .= " '$username','$password',";
            $sql .= " '$idcard','$address',";
            $sql .= " '$mobile','$email',";
            $sql .= " NOW(),0,NOW(),0,";
            $sql .=" 0";
            $sql .= " )";
            $msg = 'ลงทะเบียนผู้ใช้งานใหม่ สำเร็จ กรุณา ล๊อกอินเข้าสู่ระบบ';

            $query = mysql_query($sql) or die(mysql_error() . 'sql ::==' . $sql);
            if ($query):
                echo returnJson('success', 'information', $msg, 'index.php?page=login');
            else:
                echo returnJson('error', 'error', $msg, '');
            endif;
        endif;
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
            $id = $_POST['input-id'];
            $fname = $_POST['input-fname'];
            $lname = $_POST['input-lname'];
            $username = $_POST['input-username'];
            $password = $_POST['input-password'];
            $password_confirm = $_POST['input-password_re'];
            $idcard = $_POST['input-idcard'];
            $address = $_POST['input-address'];
            $mobile = $_POST['input-mobile'];
            $email = $_POST['input-email'];
            $status = $_POST['combo-status'];
            if (empty($_POST['input-id'])) { // NEW 
                $sql = " INSERT INTO `person`(";
                $sql .= " `per_fname`, `per_lname`,";
                $sql .= " `per_username`, `per_password`,";
                $sql .= " `per_idcard`, `per_address`,";
                $sql .= " `per_mobile`, `per_email`, ";
                $sql .= " `per_createdate`, `per_createby`, ";
                $sql .= " `per_updatedate`, `per_updateby`,";
                $sql .=" `per_status`) VALUES (";
                $sql .= " '$fname','$lname',";
                $sql .= " '$username','$password',";
                $sql .= " '$idcard','$address',";
                $sql .= " '$mobile','$email',";
                $sql .= " NOW(),$ses_id,NOW(),$ses_id,";
                $sql .=" $status";
                $sql .= " )";

                $title = 'information';
                $msg = 'เพิ่ม ผู้ใช้งาน ใหม่ สำเร็จ';
            } else { // UPDATE                               
                $sql = " UPDATE `person` SET";
                $sql .= " `per_fname`='$fname',";
                $sql .= " `per_lname`='$lname',`per_username`='$username',";
                $sql .= " `per_password`='$password',`per_idcard`='$idcard',";
                $sql .= " `per_address`='$address',`per_mobile`='$mobile',";
                $sql .= " `per_email`='$email',";
                $sql .= " `per_updatedate`=NOW(),`per_updateby`=$ses_id,";
                $sql .= " `per_status`=$status";
                $sql .= " WHERE `per_id`=$id";

                $title = 'information';
                $msg = 'แก้ไข ผู้ใช้งาน สำเร็จ';
            }
            $query = mysql_query($sql) or die(mysql_error() . 'sql :' . $sql);
            if ($query) {
                echo returnJson('success', $title, $msg, 'index.php?page=list-person');
            } else {
                exit("การประมวลผลเกิดข้อผิดพลาด");
                echo returnJson('danger', $title, $msg, '');
            }
        }
        break;
    case 'profile':
        if (!empty($_POST)) {
            $fname = $_POST['input-fname'];
            $lname = $_POST['input-lname'];
            $idcard = $_POST['input-idcard'];
            $address = $_POST['input-address'];
            $mobile = $_POST['input-mobile'];
            $email = $_POST['input-email'];

            $sql = " UPDATE `person` SET";
            $sql .= " `per_fname`='$fname',";
            $sql .= " `per_lname`='$lname',`per_idcard`='$idcard',";
            $sql .= " `per_address`='$address',`per_mobile`='$mobile',";
            $sql .= " `per_email`='$email',";
            $sql .= " `per_updatedate`=NOW(),`per_updateby`=$ses_id";
            $sql .= " WHERE `per_id`=" . $_SESSION['person']['per_id'];
            $query = mysql_query($sql) or die(mysql_error());
            if ($query) {
                $sql = "SELECT * FROM person WHERE per_id = " . $_SESSION['person']['per_id'];
                $query = mysql_query($sql) or die(mysql_error());
                $_SESSION['person'] = mysql_fetch_assoc($query);
                echo returnJson('success', 'information', 'แก้ไขข้อมูล สำเร็จ', '');
            } else {
                echo returnJson('danger', 'error', 'แก้ไขข้อมูลไม่สำเร็จ', '');
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
    case 'check_idcard':
        $idcard = $_POST['idcard'];
        if (strlen($idcard) >= 13): //จำนวนความยาวต้อง 13 ตัวอักษร
            $sql = "SELECT * FROM person WHERE per_idcard = '$idcard'";
            $query = mysql_query($sql) or die(mysql_error());
            $row = mysql_num_rows($query);
            if ($row == 0):
                // ยังไม่พบ personal id
                echo returnJson('success', 'ตรวจสอบ รหัสบัตรจากระบบ', 'ยังไม่พบ รหัสบัตรประชาชน ผ่าน', '');
            else:
                // ยังไม่พบ personal id
                echo returnJson('danger', 'ตรวจสอบ รหัสบัตรจากระบบ', 'กรอกรหัสบัตรไม่ถูกต้อง รหัสบัตรนี้มีในระบบแล้ว', '');
            endif;
        else:
            echo returnJson('danger', 'ตรวจสอบ รหัสบัตรจากระบบ', 'กรอกรหัสบัตรไม่ครบ', '');
        endif;
        break;
    case 'get_idcard':
        $idcard = $_POST['idcard'];
        if (strlen($idcard) >= 13): //จำนวนความยาวต้อง 13 ตัวอักษร
            $sql = "SELECT * FROM person WHERE per_idcard = '$idcard'";
            $query = mysql_query($sql) or die(mysql_error());
            $row = mysql_num_rows($query);
            if ($row == 1):
                $data = mysql_fetch_assoc($query);
                // เจอ รหัสบัตรผู้ใช้งาน เก่า
                echo json_encode(array(
                    'status' => 'success',
                    'title' => 'ตรวจสอบรหัสบัตรประชาชน',
                    'msg' => 'พบรหัสบัตรประชาชน ผู้ใช้งาน เป็นลูกค้ารายเก่า',
                    'person_id' => $data['per_id'],
                    'fname' => $data['per_fname'],
                    'lname' => $data['per_lname'],
                    'idcard' => $data['per_idcard'],
                    'address' => $data['per_address'],
                    'mobile' => $data['per_mobile']
                ));
            else:
                // ยังไม่พบ personal id
                echo returnJson('danger', 'ตรวจสอบ รหัสบัตรจากระบบ', 'ไม่พบรหัสบัตรประชาชน ลูกค้ารายใหม่ กรุณากรอกข้อมูล', '');
            endif;
        else:
            echo returnJson('danger', 'ตรวจสอบ รหัสบัตรจากระบบ', 'กรอกรหัสบัตรไม่ครบ', '');
        endif;
        break;
    default:
        echo 'default';
        break;
}

