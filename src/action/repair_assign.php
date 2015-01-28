<?php

@session_start();
include '../config/extension.php';
include '../config/connection.php';

$person = '';
$ses_id = '';
if (!empty($_SESSION['person'])):
    $person = $_SESSION['person'];
    $ses_id = $person['per_id'];
endif;
$msg = '';
switch ($_GET['method']) {
    case 'assign_repair':
        if (!empty($_POST)) { // ตรวจสอบการส่งค่ามา บัทึก
            $repair_id = $_POST['input-repair_id'];
            /*
             * 1 => 'รอประเมิน',
             *   2 => 'ประเมินเสร็จสิ้น รอซ่อม',
             *   3 => 'ซ่อม',
             *   4 => 'ซ่อมเสร็จแล้ว',
             *  5 => 'เกิดปัญหา'
             */
            $sql = " UPDATE `in_repair` SET";
            $sql .= " `inrep_status` = 1,"; // 1 = รอประเมิน
            $sql .= " inrep_updatedate = NOW(),";
            $sql .= " inrep_updateby = $ses_id";
            $sql .= " WHERE inrep_id = $repair_id";
            $query = mysql_query($sql) or die(mysql_error() . 'sql ::==' . $sql);
            if ($query):
                $suppose_startdate = $_POST['input-createdate'];
                $suppose_enddate = $_POST['input-enddate'];
                $employee_id = $_POST['combo-employee'];
                $repair_repairers = $_POST['input-repair_repairers'];
                if (empty($_POST['input-repair_repairers'])):
                    $sql_assign = " INSERT INTO `repair_assign`(";
                    $sql_assign .= " `rep_id`, `rep_repairers`, `rep_suppose_startdate`,";
                    $sql_assign .= " `rep_suppose_enddate`, `rep_estimate_date`,";
                    //$sql_assign .= " `rep_estimate_status`, `rep_estimate_remark`,";
                    //$sql_assign .= " `rep_estimate_price`,";
                    $sql_assign .= " `rep_actual_startdate`,";
                    $sql_assign .= " `rep_actual_enddate`, `rep_status_remark`) VALUES (";
                    $sql_assign .= " $repair_id,$employee_id,STR_TO_DATE('$suppose_startdate','%d-%m-%Y'),";
                    $sql_assign .= " STR_TO_DATE('$suppose_enddate','%d-%m-%Y'),NOW(),";
                    //$sql_assign .= " 1,'',";
                    //$sql_assign .= " 0,";
                    $sql_assign .= " NOW(),";
                    $sql_assign .= " NOW(),''";
                    $sql_assign .= " )";
                    $msg = 'หมอบหมายงาน เรียบร้อย';
                else:
                    $sql_assign = " UPDATE `repair_assign` SET ";
                    $sql_assign .= " `rep_repairers` = $employee_id,";
                    $sql_assign .= " `rep_suppose_startdate` = STR_TO_DATE('$suppose_startdate','%d-%m-%Y'),";
                    $sql_assign .= " `rep_suppose_enddate` = STR_TO_DATE('$suppose_enddate','%d-%m-%Y')";
                    $sql_assign .= " WHERE rep_id = $repair_repairers";
                    $msg = 'แก้ไข หมอบหมายงาน เรียบร้อย';
                endif;
                //echo 'sql ::=='.$sql_assign;
                $query_assign = mysql_query($sql_assign) or die(mysql_error() . 'sql ::==' . $sql_assign);
                if ($query_assign):
                    echo returnJson('success', 'information', $msg, '');
                else:
                    echo returnJson('danger', 'information', 'เกิดข้อผิดพลาด ให้การประมวลผล', '');
                endif;
            else:
                echo returnJson('danger', 'information', 'เกิดข้อผิดพลาด ให้การประมวลผล', '');
            endif;
        }
        break;
    default:
        break;
}