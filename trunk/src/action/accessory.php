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
                $sql = " INSERT INTO `accessory`(";
                $sql .= " `acc_name`, `acc_desc`, `acc_createdate`, ";
                $sql .= " `acc_createby`, `acc_updatedate`, `acc_updateby`)";
                $sql .= " VALUES (";
                $sql .= " '$name','$desc',NOW(),";
                $sql .= " $per_id,NOW(),$per_id";
                $sql .= " )";
                $title = 'information';
                $msg = 'เพิ่ม อุปกรณ์เสริม ใหม่ สำเร็จ';
            } else { // NEW                               
                $sql = " UPDATE `accessory` SET ";
                $sql .= " `acc_name`='$name',";
                $sql .= " `acc_desc`='$desc',";
                $sql .= " `acc_updatedate`=NOW(),";
                $sql .= " `acc_updateby`=$per_id";
                $sql .= " WHERE acc_id = $id";
                $title = 'information';
                $msg = 'แก้ไข อุปกรณ์เสริม สำเร็จ';
            }
            $query = mysql_query($sql) or die(mysql_error() . 'sql :' . $sql);
            if ($query) {
                echo returnJson('success', $title, $msg, 'index.php?page=list-accessory');
            } else {
                echo returnJson('danger', $title, $msg, '');
            }
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $query = mysql_query("DELETE FROM accessory WHERE acc_id = $id") or die(mysql_error());
        if ($query) {
            echo returnJson('success', 'information', 'ลบสำเร็จ', '');
        }
        break;
    case 'get_list_accessory':
        $repair_id = $_POST['repair_id'];
        if (!empty($_POST)) {
            $list = [];
            $sql = "SELECT * FROM in_repair_accessory ir_a";
            $sql .= " LEFT JOIN accessory a ON a.acc_id = ir_a.acc_id";
            $sql .= " WHERE ir_a.inrep_id = $repair_id";
            $query = mysql_query($sql) or die(mysql_error());
            while ($data = mysql_fetch_array($query)) {
                $list[] = $data;
            }
            echo json_encode($list);
        }
        break;
    default:
        break;
}



