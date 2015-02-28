<?php
header('Content-Type: text/html; charset=utf-8');
include '../../MPDF57/mpdf.php';
include '../config/connection.php';

$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
$option = $_GET['option'];
$sql = " SELECT inrep_id,inrep_code,";
$sql .= " CONCAT(per_fname,' ',per_lname) customer,";
$sql .= " DATE_FORMAT(`inrep_createdate`,'%d-%m-%Y') inrep_createdate,";
$sql .= " DATE_FORMAT(`inrep_getdate`,'%d-%m-%Y') inrep_getdate,";
$sql .= " DATE_FORMAT(`rep_suppose_startdate`,'%d-%m-%Y') rep_suppose_startdate,";
$sql .= " DATE_FORMAT(`rep_suppose_enddate`,'%d-%m-%Y') rep_suppose_enddate,";
$sql .= " DATEDIFF( ra.`rep_suppose_enddate` , ra.`rep_suppose_startdate` ) count_working,";
$sql .= " rep_estimate_price";
$sql .= " FROM `in_repair` ir";
$sql .= " LEFT JOIN repairers ra ON ra.rep_id = ir.inrep_id";
$sql .= " LEFT JOIN person p ON p.per_id = ir.per_id";
$sql .= " WHERE 1=1";
if ($option == '1') {   //วันที่มาให้ร้านซ่อม
    $sql .= " AND (`inrep_createdate` BETWEEN";
    $sql .= " STR_TO_DATE('$start_date','%Y-%m-%d')";
    $sql .= " AND ";
    $sql .= " STR_TO_DATE('$end_date','%Y-%m-%d'))";
    $option = 'วันที่มาให้ร้านซ่อม';
} else if ($option == '2') {  // วันที่มารับของ
    $sql .= " AND (`inrep_getdate` BETWEEN";
    $sql .= " STR_TO_DATE('$start_date','%Y-%m-%d')";
    $sql .= " AND ";
    $sql .= " STR_TO_DATE('$end_date','%Y-%m-%d'))";
    $option = 'วันที่มารับของ';
} else if ($option == '3') {  // วันที่เริ่มซ่อม
    $sql .= " AND (`rep_suppose_startdate` BETWEEN";
    $sql .= " STR_TO_DATE('$start_date','%Y-%m-%d')";
    $sql .= " AND ";
    $sql .= " STR_TO_DATE('$end_date','%Y-%m-%d'))";
    $option = 'วันที่เริ่มซ่อม';
} else if ($option == '4') {  // วันที่สิ้นสุดซ่อม
    $sql .= " AND (`rep_suppose_enddate` BETWEEN";
    $sql .= " STR_TO_DATE('$start_date','%Y-%m-%d')";
    $sql .= " AND ";
    $sql .= " STR_TO_DATE('$end_date','%Y-%m-%d'))";
    $option = 'วันที่สิ้นสุดซ่อม';
}

$query = mysql_query($sql) or die(mysql_error());

ob_start();
echo '<link type="text/css" rel="stylesheet" href="../../css/report_style.css"/>';
?>
<h2 style="text-align: center">รายงานสรุปการซ่อม ประเภท <?= $option ?> ตั้งแต่วันที่ <?= $start_date ?> ถึง <?= $end_date ?></h2>
<!--<p>option :: <?= $option ?><br/>sql ::==<?= $sql ?></p>-->
<table class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>รหัสการซ่อม</th>
            <th>ชื่อลูกค้า</th>
            <th>วันมาติดต่อซ่อม</th>
            <th>วันรับเครื่องคืน</th>
            <th>วันเริ่มซ่อม</th>
            <th>วันซ่อมเสร็จ</th>
            <th>ระยะเวลาการซ่อม</th>
            <th>ราคา</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php while ($data = mysql_fetch_array($query)) { ?>            
            <tr>
                <td style="text-align: center;width: 5%"><?= $i ?></td>
                <td style="text-align: center;width: 10%"><?= $data['inrep_code'] ?></td>
                <td style="text-align: left;width: 15%"><?= $data['customer'] ?></td>
                <td style="text-align: center;width: 10%"><?= $data['inrep_createdate'] ?></td>
                <td style="text-align: center;width: 10%"><?= $data['inrep_getdate'] ?></td>
                <td style="text-align: center;width: 10%"><?= $data['rep_suppose_startdate'] ?></td>
                <td style="text-align: center;width: 10%"><?= $data['rep_suppose_enddate'] ?></td>
                <td style="text-align: center;width: 5%"><?= $data['count_working'] ?></td>
                <td style="text-align: center;width: 10%"><?= $data['rep_estimate_price'] ?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </tbody>
</table>
<?php
$html = ob_get_contents();
ob_clean();
$mpdf = new mPDF("UTF-8");
$mpdf->SetAutoFont();
$mpdf->AddPage('L');
$mpdf->Write($stylesheet, 1);
$mpdf->WriteHTML($html);
$mpdf->Output('รายงานสรุปการซ่อม ' . $option . ' ตั้งแต่วันที่ ' . $start_date . ' ถึง  ' . $end_date . '.pdf', 'D');
?>
