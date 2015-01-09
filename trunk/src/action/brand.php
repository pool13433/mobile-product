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
                $sql = " INSERT INTO `brand`(";
                $sql .= " `bra_nameth`, `bra_nameeng`, `bra_createdate`, ";
                $sql .= " `bra_createby`, `bra_updatedate`, `bra_updateby`)";
                $sql .= " VALUES (";
                $sql .= " '$nameth','$nameeng',NOW(),";
                $sql .= " $per_id,NOW(),$per_id";
                $sql .= " )";
                $title = 'information';
                $msg = 'เพิ่ม ยี้ห้อ ใหม่ สำเร็จ';
            } else { // NEW                               
                $sql = " UPDATE `brand` SET ";
                $sql .= " `bra_nameth`='$nameth',";
                $sql .= " `bra_nameeng`='$nameeng',";
                $sql .= " `bra_updatedate`=NOW(),";
                $sql .= " `bra_updateby`=$per_id";
                $sql .= " WHERE bra_id = $id";
                $title = 'information';
                $msg = 'แก้ไข ยี้ห้อ สำเร็จ';
            }
            $query = mysql_query($sql) or die(mysql_error() . 'sql :' . $sql);
            if ($query) {
                echo returnJson('success', $title, $msg, 'index.php?page=list-brand');
            } else {
                echo returnJson('danger', $title, $msg, '');
            }
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $query = mysql_query("DELETE FROM brand WHERE bra_id = $id") or die(mysql_error());
        if ($query) {
            echo returnJson('success', 'information', 'ลบสำเร็จ', '');
        }
        break;
    default:
        break;
}



