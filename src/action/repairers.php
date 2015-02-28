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
                    $sql_assign = " INSERT INTO `repairers`(";
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
                    $sql_assign = " UPDATE `repairers` SET ";
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
    case 'update_appraisers':
        $id = $_POST['id'];
        $remark = $_POST['remark'];
        $status = $_POST['status'];
        $price = $_POST['price'];
        if (!empty($_POST)) {
            $sql_in_repair = "UPDATE in_repair SET ";
            $sql_in_repair .= " inrep_status = 2"; //   2 => 'ประเมินเสร็จสิ้น รอซ่อม',
            $sql_in_repair .= " WHERE inrep_id = $id";
            $query_in = mysql_query($sql_in_repair) or die(mysql_error());
            if ($query_in) {
                $sql_assign = "UPDATE repairers SET ";
                $sql_assign .= " rep_estimate_status = $status,";
                $sql_assign .= " rep_estimate_date = NOW(),";
                $sql_assign .= " rep_estimate_price = $price,";
                $sql_assign .= " rep_estimate_remark = '$remark'";
                $sql_assign .= " WHERE rep_id = $id";
                $query_assign = mysql_query($sql_assign) or die(mysql_error());
                if ($query_assign) {
                    echo returnJson('success', 'information', 'ประเมินราคา เสร็จสิ้น', '');
                } else {
                    echo returnJson('danger', 'error', 'ไม่สามารถ ประเมินราคาได้', '');
                }
            } else {
                echo returnJson('danger', 'error', 'ไม่สามารถ อัพเดทตารางหลักได้', '');
            }
        }
        break;
    case 'update_approve':
        $repair_id = $_POST['repair_id'];
        $status = $_POST['status'];
        if (!empty($_POST)) {
            $sql = "UPDATE in_repair SET";
            $sql .= " inrep_status = $status";
            $sql .= " WHERE inrep_id = $repair_id";
            $query = mysql_query($sql) or die(mysql_error());
            if ($query) {
                if ($status == '3') {
                    echo returnJson('success', 'information', 'อนุมัติการซ่อมเรียบร้อยแล้ว', '');
                } else if ($status == '4') {
                    echo returnJson('success', 'information', 'ยกเลิกการซ่อมเรียบร้อยแล้ว', '');
                }
            } else {
                echo returnJson('danger', 'error', 'ไม่สามารถ เปล่ียนแปลงสถานะได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ', '');
            }
        }
        break;
    case 'start_repair':
        $repair_status = $_POST['repair_status']; // 5 = เริ่มการซ่อม
        $repair_id = $_POST['repair_id'];

        $sql = "UPDATE in_repair SET ";
        $sql .= " inrep_status = $repair_status"; // 5
        $sql .= " WHERE inrep_id = $repair_id";
        $query = mysql_query($sql) or die(mysql_error() . 'sql ::==' . $sql);
        if ($query) {
            $sql = "UPDATE repairers SET ";
            $sql .= " rep_actual_startdate = NOW()";
            $sql .= " WHERE rep_id = $repair_id";
            $query = mysql_query($sql) or die(mysql_error());
            if ($query) {
                echo returnJson('success', 'information', 'เริ่มการซ่อม', 'index.php?page=list-repair');
            } else {
                echo returnJson('danger', 'information', 'เริ่มการซ่อม เกิดปัญหา', '');
            }
        } else {
            echo returnJson('danger', 'information', 'ส่งงานซ่อมเกิดปัญหา', '');
        }

        break;
    case 'end_repair':
        $repair_status = $_POST['repair_status'];
        $repair_status_remark = $_POST['repair_status_remark'];
        $repair_id = $_POST['repair_id'];

        $sql = "UPDATE in_repair SET ";
        $sql .= " inrep_status = $repair_status"; // 6 , 7 
        $sql .= " WHERE inrep_id = $repair_id";
        $query = mysql_query($sql) or die(mysql_error() . 'sql ::==' . $sql);
        if ($query) {
            $sql = "UPDATE repairers SET ";
            $sql .= " rep_actual_enddate = NOW(),";
            $sql .= " rep_status_remark = '$repair_status_remark'";
            $sql .= " WHERE rep_id = $repair_id";
            $query = mysql_query($sql) or die(mysql_error());
            if ($query) {
                echo returnJson('success', 'information', 'ส่งงานซ่อมเสร็จสิ้น', 'index.php?page=list-repair');
            } else {
                echo returnJson('danger', 'information', 'ส่งงานซ่อมเกิดปัญหา', '');
            }
        } else {
            echo returnJson('danger', 'information', 'ส่งงานซ่อมเกิดปัญหา', '');
        }
        break;
    case 'finish_repair':
        $repair_id = $_POST['repair_id'];
        $json_accessory = $_POST['accessory'];        
        if (!empty($_POST)) {
            $sql = "UPDATE in_repair SET ";
            $sql .= " inrep_status = 8,"; // 8 => 'รอรับของ'
            $sql .= " inrep_realdate = NOW()";
            $sql .= " WHERE inrep_id = $repair_id";
            $query = mysql_query($sql) or die(mysql_error());
            if ($query) {
                // ##########  loop ############                                
                $array_accessory = json_decode($json_accessory, true);                      
                foreach ($array_accessory as $key => $data) {
                    $sql = " UPDATE in_repair_accessory SET ";
                    $sql .= " inrepacc_check = " . $data['acc_check'];
                    $sql .= " WHERE inrepacc_id = " . $data['acc_id'];
                    $query = mysql_query($sql) or die(mysql_error());
                }
                if ($query) {
                    echo returnJson('success', 'information', 'ส่งงานลุกค้าเสร็จสิ้น', 'index.php?page=list-repair');
                } else {
                    echo returnJson('danger', 'error', 'ส่งงานลุกค้าเกิดปัญหา', '');
                }
            } else {
                echo returnJson('danger', 'error', 'ส่งงานลุกค้าเกิดปัญหา', '');
            }
        }
        break;
    default:
        break;
}