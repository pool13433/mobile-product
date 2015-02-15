<?php
header('Content-Type: text/html; charset=utf-8');
include '../../MPDF57/mpdf.php';
include '../config/connection.php';

$sql = " SELECT prob_name,count(*) count_problem";
$sql .= " FROM problem p";
$sql .= " LEFT JOIN in_repair_problem ir_p ON ir_p.prob_id = p.prob_id";
$sql .= " GROUP BY prob_name";
$sql .= " ORDER BY count(*) DESC";

$query = mysql_query($sql) or die(mysql_error());
ob_start();
echo '<link type="text/css" rel="stylesheet" href="../../css/report_style.css"/>';
?>
<h2 style="text-align: center">รายงานสรุปยอดปัญหาที่มักพบบ่อยจากการซ่อมเครื่องโทรศัพท์มือถือ</h2>
<table class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อปัญหา</th>
            <th>จำนวน/ครั้ง</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php while ($data = mysql_fetch_array($query)) { ?>
            <tr>
                <td style="text-align: center;width: 15%"><?= $i ?></td>
                <td style="text-align: left;width: 55%"><?= $data['prob_name'] ?></td>
                <td style="text-align: center;width: 30%"><?= $data['count_problem'] ?></td>
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
$mpdf->AddPage('P');
$mpdf->Write($stylesheet, 1);
$mpdf->WriteHTML($html);
$mpdf->Output('รายงานยอดปัญหาการซ่อม.pdf', 'D');
?>
