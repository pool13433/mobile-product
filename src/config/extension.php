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
