<?php
  // เอาไว้ทำตัวอย่าง โค๊ด
@session_start();
include '../config/extension.php';
include '../config/connection.php';

$person = '';
$ses_id = '';
if (!empty($_SESSION['person'])):
    $person = $_SESSION['person'];
    $ses_id = $person['per_id'];
endif;
$message = '';
switch ($_GET['method']) {
    case 'assign_repair':
        if (!empty($_POST)):
            $repair_id = $_POST['repair_id'];
            $employee_id = $_POST['employee_id'];
            $sql = " UPDATE `in_repair` SET";
            $sql .= " `inrep_repairers`=$employee_id,";
            $sql .= " `inrep_startrepair`=NOW(),";
            $sql .= " `inrep_status` = 1,"; // 1 = กำลังซ่อม
            $sql .= " `inrep_endrepair`=NOW()";
            $sql .= " WHERE inrep_id = $repair_id";
            $query = mysql_query($sql) or die(mysql_error());
            if ($query):
                echo returnJson('success', 'information', 'หมอบหมายงาน เรียบร้อย', '');
            else:
                echo returnJson('danger', 'information', 'เกิดข้อผิดพลาด ให้การประมวลผล', '');
            endif;
        else:
            echo returnJson('danger', 'information', 'ไม่มีการส่งค่า', '');
        endif;
        break;
    case 'send_repair':
        $repair_status = $_POST['repair_status'];
        $repair_status_remark = $_POST['repair_status_remark'];
        $repair_id = $_POST['repair_id'];
        $sql = "UPDATE in_repair SET ";
        $sql .= " inrep_status = $repair_status,";
        $sql .= " inrep_endrepair = NOW()";
        if (!empty($_POST['repair_status_remark'])):
            $sql .= " ,inrep_status_remark = '$repair_status_remark'";
        endif;
        $sql .= " WHERE inrep_id = $repair_id";
        $query = mysql_query($sql) or die(mysql_error() . 'sql ::==' . $sql);
        if ($query) {
            echo returnJson('success', 'information', 'ส่งงานซ่อมเสร็จสิ้น', 'index.php?page=list-repair');
        } else {
            echo returnJson('danger', 'information', 'ส่งงานซ่อมเกิดปัญหา', '');
        }
        break;
    default:
        break;
}

