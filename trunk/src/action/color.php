<?php

session_start();
include '../config/connection.php';
include '../config/extension.php';
$person = $_SESSION['person'];
$msg = '';
$title = 'error';
switch ($_GET['method']) {
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
        $query = mysql_query("DELETE FROM color WHERE col_id = $id") or die(mysql_error());
        if ($query) {
            echo returnJson('success', 'information', 'ลบสำเร็จ', '');
        }
        break;
    default:
        break;
}