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
            $model = $_POST['combo-model'];
            $color = $_POST['combo-color'];
            if (empty($_POST['input-id'])) { // UPDATE 
                $sql = " INSERT INTO `product`(";
                $sql .= " `prod_name`, `prod_desc`,";
                $sql .= " `col_id`,`mod_id`, `prod_createdate`, ";
                $sql .= " `prod_createby`, `prod_updatedate`, `prod_updateby`)";
                $sql .= " VALUES (";
                $sql .= " '$name','$desc',";
                $sql .= " $color,$model,NOW(),";
                $sql .= " $per_id,NOW(),$per_id";
                $sql .= " )";
                $title = 'information';
                $msg = 'เพิ่ม มือถือ ใหม่ สำเร็จ';
            } else { // NEW                               
                $sql = " UPDATE `product` SET ";
                $sql .= " `prod_name`='$name',";
                $sql .= " `prod_desc`='$desc',";
                $sql .= " `col_id` = $color,";
                $sql .= " `mod_id` = $model,";
                $sql .= " `prod_updatedate`=NOW(),";
                $sql .= " `prod_updateby`=$per_id";
                $sql .= " WHERE prod_id = $id";
                $title = 'information';
                $msg = 'แก้ไข มือถือ สำเร็จ';
            }
            $query = mysql_query($sql) or die(mysql_error() . 'sql :' . $sql);
            if ($query) {
                echo returnJson('success', $title, $msg, 'index.php?page=list-product');
            } else {
                echo returnJson('danger', $title, $msg, '');
            }
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $query = mysql_query("DELETE FROM product WHERE prod_id = $id") or die(mysql_error());
        if ($query) {
            echo returnJson('success', 'information', 'ลบสำเร็จ', '');
        }
        break;
    default:
        break;
}



