<?php
header('Content-Type: text/html; charset=utf-8');
include '../../MPDF57/mpdf.php';
include '../config/connection.php';

$sql = " SELECT concat( p.per_fname, ' ', p.per_lname ) employee,";
$sql .= " ir.inrep_code, ir.inrep_getdate, ra.`rep_suppose_startdate` , ";
$sql .= " ra.`rep_suppose_enddate` , ";
$sql .= " DATEDIFF( ra.`rep_suppose_enddate` , ra.`rep_suppose_startdate` ) count_working,";
$sql .= " CASE `rep_estimate_status`";
$sql .= " WHEN 1";
$sql .= " THEN 'รับซ่อม'";
$sql .= " WHEN 2";
$sql .= " THEN 'ไม่รับซ่อม'";
$sql .= " ELSE 'ยังไม่ประเมิน'";
$sql .= " END rep_estimate_status, `rep_estimate_remark` , `rep_estimate_price`";
$sql .= " FROM person p";
$sql .= " LEFT JOIN repair_assign ra ON ra.`rep_repairers` = p.per_id";
$sql .= " LEFT JOIN in_repair ir ON ir.inrep_id = ra.rep_id";
$sql .= " WHERE p.per_status =2";
$sql .= " ORDER BY p.per_fname, ir.inrep_code ASC ";


$query = mysql_query($sql) or die(mysql_error());
ob_start();
echo '<link type="text/css" rel="stylesheet" href="../../css/report_style.css"/>';
?>
<h2 style="text-align: center">รายงานสรุป ภาระงานของช่างแต่ละคน</h2>
<table class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อช่าง</th>
            <th>รหัสงานซ่อม</th>
            <th>วันรับงาน</th>
            <th>วันเริ่มซ่อม</th>
            <th>วันซ่อมเสร็จ</th>
            <th>ระยะเวลาการซ่อม</th>
            <th>ประเมิน</th>
            <th>หมายเหตุ</th>
            <th>ราคา</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php $run = 1; ?>
        <?php $employee = ''; ?>
        <?php while ($data = mysql_fetch_array($query)) { ?>            
            <tr>
                <td style="text-align: center;width: 10%">
                    <?php
                    if ($employee != $data['employee']) {
                        echo $i;
                    }
                    ?>
                </td>
                <td style="text-align: left;width: 25%">
                    <?php
                    if ($employee != $data['employee']) {
                        echo $data['employee'];
                        $employee = $data['employee'];
                        $i++;
                    }
                    ?>
                </td>
                <td style="text-align: center;width: 15%"><?= $data['inrep_code'] ?></td>
                <td style="text-align: center;width: 10%"><?= $data['inrep_getdate'] ?></td>
                <td style="text-align: center;width: 10%"><?= $data['rep_suppose_startdate'] ?></td>
                <td style="text-align: center;width: 10%"><?= $data['rep_suppose_enddate'] ?></td>
                <td style="text-align: center;width: 10%"><?= $data['count_working'] ?></td>
                <td style="text-align: center;width: 10%"><?= $data['rep_estimate_status'] ?></td>
                <td style="text-align: center;width: 15%"><?= $data['rep_estimate_remark'] ?></td>
                <td style="text-align: center;width: 10%"><?= $data['rep_estimate_price'] ?></td>
            </tr>
        <?php }
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
$mpdf->Output('รายงานสรุป ภาระงานของช่างแต่ละคน.pdf', 'D');
?>
