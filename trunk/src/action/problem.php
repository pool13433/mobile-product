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
            $name = $_POST['input-name'];
            $desc = $_POST['input-desc'];
            if (empty($_POST['input-id'])) { // UPDATE 
                $sql = " INSERT INTO `problem`(";
                $sql .= " `prob_name`, `prob_desc`, `prob_createdate`, ";
                $sql .= " `prob_createby`, `prob_updatedate`, `prob_updateby`)";
                $sql .= " VALUES (";
                $sql .= " '$name','$desc',NOW(),";
                $sql .= " $per_id,NOW(),$per_id";
                $sql .= " )";
                $title = 'information';
                $msg = 'เพิ่ม ปัญหา ใหม่ สำเร็จ';
            } else { // NEW                               
                $sql = " UPDATE `problem` SET ";
                $sql .= " `prob_name`='$name',";
                $sql .= " `prob_desc`='$desc',";
                $sql .= " `prob_updatedate`=NOW(),";
                $sql .= " `prob_updateby`=$per_id";
                $sql .= " WHERE prob_id = $id";
                $title = 'information';
                $msg = 'แก้ไข ปัญหา สำเร็จ';
            }
            $query = mysql_query($sql) or die(mysql_error() . 'sql :' . $sql);
            if ($query) {
                echo returnJson('success', $title, $msg, 'index.php?page=list-problem');
            } else {
                echo returnJson('danger', $title, $msg, '');
            }
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $query = mysql_query("DELETE FROM problem WHERE prob_id = $id") or die(mysql_error());
        if ($query) {
            echo returnJson('success', 'information', 'ลบสำเร็จ', '');
        }
        break;
    default:
        break;
}



