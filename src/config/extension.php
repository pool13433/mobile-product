<?php

date_default_timezone_set('UTC');
define("MAINPAGE", "login.php");

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

function repair_status() {
    return array(
        '0' => 'รอซ่อม',
        '1' => 'ซ่อม',
        '2' => 'ซ่อมเสร็จแล้ว',
        '3' => 'เกิดปัญหา'
    );
}
function change_dateDMY_TO_YMD($beforDate) {
    $array = explode("/", $beforDate);
    return $array[2] . "-" . $array[1] . "-" . $array[0];
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

function change_dateYMD_TO_DMY($beforDate) {
    if (!empty($beforDate)) {
        $array = explode("-", $beforDate);
        return $array[2] . "/" . $array[1] . "/" . $array[0];
    } else {
        return "";
    }
}
