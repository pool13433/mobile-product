<?php

date_default_timezone_set('UTC');
define("MAINPAGE", "choice.php");

// ########### ประกาศค่าคงที่ ##########
define('EMPLOYEE_STATUS', 1);  // พนักงานร้าน
define('REPAIRMAN_STATUS', 2); // พนักงานซ่อม
define('ONWER_STATUS', 3);
define('CUSTOMER_STATUS', 4);

// ########### ประกาศค่าคงที่ ##########

function returnJson($status, $title, $msg, $url) {
    return json_encode(array(
        'status' => $status,
        'title' => $title,
        'msg' => $msg,
        'url' => $url
    ));
}

function format_date($format, $date) {
    $date_format = new DateTime($date);
    $new_date = $date_format->format($format);
    return $new_date;
}

function change_dateDMY_TO_YMD($beforDate) {
    $array = explode("/", $beforDate);
    return $array[2] . "-" . $array[1] . "-" . $array[0];
}

function change_dateYMD_TO_DMY($beforDate) {
    if (!empty($beforDate)) {
        $array = explode("-", $beforDate);
        return $array[2] . "/" . $array[1] . "/" . $array[0];
    } else {
        return date('d-m-Y');
    }
}

function listPersonStatus() {
    return array(
        '1' => 'พนักงานร้าน',
        '2' => 'พนักงานซ่อม',
        '3' => 'เจ้าของร้าน',
        '4' => 'ลูกค้า',
    );
}

function listRepairStatus() {
    return array(
        1 => 'รอประเมิน',
        2 => 'ประเมินเสร็จสิ้น รอ อนุมัตจากเจ้าของเครื่อง',
        3 => 'อนุมัติการซ่อม จากลูกค้าเรียบร้อยแล้ว',
        4 => 'ยกเลิก/ไม่อนุมัติการซ่อม จากลูกค้า',
        5 => 'ซ่อม',
        6 => 'ซ่อมเสร็จแล้ว',
        7 => 'เกิดปัญหา',
        8 => '<i class="glyphicon glyphicon-ok"></i> รับของเสร็จสิ้น จบการซ่อม'
    );
}

function listRepairAppraisers() {
    return array(
        '0' => 'รอ ประเมิน',
        '1' => 'รับซ่อม',
        '2' => 'ไม่รับซ่อม แล้ว สาเหตุเพราะเครื่อง เก่ามาก'
    );
}

function listRepairStatusColor() {
    return array(
        1 => 'warning',
        2 => 'primary',
        3 => 'success',
        4 => 'danger',
        5 => 'info',
        6 => 'success',
        7 => 'danger',
        8 => 'success',
    );
}

function getDataList($params, $list) {
    $array = $list;
    if (!empty($params)):
        $result = "";
        foreach ($array as $key => $value):
            if ($key == $params):
                $result = $value;
            endif;
        endforeach;
        return $result;
    endif;
}

function listPersonStatusColor() {
    return array(
        '1' => 'success',
        '2' => 'warning',
        '3' => 'primary',
        '4' => 'danger',
    );
}

function print_sql($sql) {
    return '<textarea class="form-control"> sql ::==> ' . $sql . '</textarea>';
}

function Gen_Code($code) {
    $code = intval($code) + 1;
    $nextNumber = "00000";
    // 00001
    if ($code < 10) { //9
        $nextNumber = "0000" . $code;
        return $nextNumber;
    } else {
        if ($code < 100) { // 99
            $nextNumber = "000" . $code;
            return $nextNumber;
        } else {
            if ($code < 1000) { // 999 
                $nextNumber = "00" . $code;
                return $nextNumber;
            } else {
                if ($code < 10000) { // 9999
                    $nextNumber = "0" . $code;
                    return $nextNumber;
                } else {
                    if ($code < 1) { // 99999
                        $nextNumber = "" . $code;
                        return $nextNumber;
                    } else {
                        if ($code < 10) { //999999
                            $nextNumber = "0000" . $code;
                            return $nextNumber;
                        } else {
                            if ($code < 100) { //9999999
                                $nextNumber = "000" . $code;
                                return $nextNumber;
                            } else {
                                if ($code < 1000) { //99999999
                                    $nextNumber = "00" . $code;
                                    return $nextNumber;
                                } else {
                                    if ($code < 10000) { //99999999
                                        $nextNumber = "0" . $code;
                                        return $nextNumber;
                                    } else {
                                        return -1;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
