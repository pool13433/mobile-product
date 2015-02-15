<?php
header('Content-Type: text/html; charset=utf-8');
include '../../MPDF57/mpdf.php';
include '../config/connection.php';

if (!empty($_GET)) {
    $repair_id = $_GET['repair_id'];
    $sql_repair = "SELECT ";
    $sql_repair .=" `inrep_id`,";
    $sql_repair .="  CASE `inrep_status`";
    $sql_repair .="  WHEN 1 THEN 'รอประเมิน'";
    $sql_repair .="  WHEN 2 THEN 'ประเมินเสร็จสิ้น รอ อนุมัตจากเจ้าของเครื่อง'";
    $sql_repair .="  WHEN 3 THEN 'อนุมัติการซ่อม จากลูกค้าเรียบร้อยแล้ว'";
    $sql_repair .="  WHEN 4 THEN 'ยกเลิก/ไม่อนุมัติการซ่อม จากลูกค้า'";
    $sql_repair .="  WHEN 5 THEN 'ซ่อม'";
    $sql_repair .="  WHEN 6 THEN 'ซ่อมเสร็จแล้ว'";
    $sql_repair .="  WHEN 7 THEN 'เกิดปัญหา'";
    $sql_repair .="  WHEN 8 THEN 'รับของเสร็จสิ้น จบการซ่อม'";
    $sql_repair .="  END inrep_status,";
    $sql_repair .="  `inrep_code`,";
    $sql_repair .= " DATE_FORMAT(`inrep_createdate`,'%d/%m/%Y') inrep_createdate,";
    $sql_repair .= " DATE_FORMAT(`inrep_getdate`,'%d/%m/%Y') inrep_getdate,";
    $sql_repair .= " DATE_FORMAT(`inrep_realdate`,'%d/%m/%Y') inrep_realdate,";
    //$sql_repair .=" ir.`per_id`,";
    $sql_repair .=" `bra_id`, `mod_id`, `inrep_emi`, `col_id`, `inrep_remark`,";
    $sql_repair .=" `inrep_accessory_other`, `inrep_problem_other`,";
    $sql_repair .=" `inrep_createby`, `inrep_updatedate`, `inrep_updateby`,";
    $sql_repair .= " p.`per_id`, `per_status`, `per_fname`, `per_lname`, `per_username`, ";
    $sql_repair .= " `per_password`, `per_idcard`, `per_address`, `per_mobile`,";
    $sql_repair .= " `per_email`, `per_createdate`, `per_createby`, ";
    $sql_repair .= " `per_updatedate`, `per_updateby`,";
    $sql_repair .= " `rep_id`, `rep_repairers`,  ";
    $sql_repair .= " DATE_FORMAT(`rep_suppose_startdate`,'%d/%m/%Y') rep_suppose_startdate,";
    $sql_repair .= " DATE_FORMAT(`rep_suppose_enddate`,'%d/%m/%Y') rep_suppose_enddate,";
    $sql_repair .= " DATE_FORMAT(`rep_estimate_date`,'%d/%m/%Y') rep_estimate_date,";
    $sql_repair .= "  CASE `rep_estimate_status`";
    $sql_repair .= "  WHEN 1 THEN 'รับซ่อม'";
    $sql_repair .= "  WHEN 2 THEN 'ไม่รับซ่อม เครื่องเก่าเกินซ่อม'";
    $sql_repair .= "  END  rep_estimate_status,";
    $sql_repair .= " `rep_estimate_remark`, `rep_estimate_price`,";
    $sql_repair .= " DATE_FORMAT(`rep_actual_startdate`,'%d/%m/%Y') rep_actual_startdate,";
    $sql_repair .= " DATE_FORMAT(`rep_actual_enddate`,'%d/%m/%Y') rep_actual_enddate,";
    $sql_repair .= " `rep_status_remark`";
    $sql_repair .= " ";
    $sql_repair .=" FROM in_repair ir ";
    $sql_repair .=" LEFT JOIN person p ON p.per_id = ir.per_id";
    $sql_repair .= " LEFT JOIN repair_assign ra ON ra.rep_id = ir.inrep_id";
    $sql_repair .=" WHERE inrep_id = $repair_id";
    $query_repair = mysql_query($sql_repair) or die(mysql_error());
    $repair = mysql_fetch_assoc($query_repair);
    ob_start();
    echo '<link type="text/css" rel="stylesheet" href="../../css/report_style.css"/>';
    ?>
    <h2 style="text-align: center">ข้อมูลใบซ่อม เลขที่ <?= $repair['inrep_code'] ?></h2>
    <table>
        <tbody>
            <tr>
                <td>รหัสใบซ่อม</td>
                <td><p style="text-decoration: underline;"><?= $repair['inrep_code'] ?></p></td>
                <td>วันที่ซ่อม</td>
                <td><p style="text-decoration: underline;"><?= $repair['inrep_createdate'] ?></p></td>
            </tr>
            <tr>
                <td>ชื่อ-สกุล</td>
                <td><p style="text-decoration: underline;"><?= $repair['per_fname'] . '   ' . $repair['per_lname'] ?></p></td>
                <td>เลขบัตรประชาชน</td>
                <td><p style="text-decoration: underline;"><?= $repair['per_idcard'] ?></p></td>
            </tr>
            <tr>
                <td>เบอร์โทร</td>
                <td><p style="text-decoration: underline;"><?= $repair['per_mobile'] ?></p></td>    
                <td>อีเมลล์</td>
                <td><p style="text-decoration: underline;"><?= $repair['per_email'] ?></p></td>
            </tr>
            <tr>              
                <td>ที่อยู่</td>
                <td colspan="3"><p style="text-decoration: underline;"><?= $repair['per_address'] ?></p></td>
            </tr>
            <tr>
                <td>วันที่นัดมารับเครื่อง</td>
                <td><p style="text-decoration: underline;"><?= $repair['inrep_getdate'] ?></p></td>
                <td>วันที่มารับเครื่องจริง</td>
                <td><p style="text-decoration: underline;"><?= $repair['inrep_realdate'] ?></p></td>
            </tr>
            <tr>
                <td>ปัญหา</td>
                <td>
                    <p style="text-decoration: underline;">
                        <?php
                        $str_problem = '';
                        $sql_problem = "SELECT * FROM in_repair_problem ir_p";
                        $sql_problem .= " JOIN problem p ON p.prob_id = ir_p.prob_id";
                        $sql_problem .= " WHERE inrep_id = " . $repair['inrep_id'];
                        $query_problem = mysql_query($sql_problem) or die(mysql_error());
                        while ($problem = mysql_fetch_array($query_problem)) {
                            if (empty($str_problem)) {
                                $str_problem .= ' * ' . $problem['prob_name'];
                            } else {
                                $str_problem .= ' * ' . $problem['prob_name'];
                            }
                            $str_problem .= ' <br/> ';
                        }
                        echo $str_problem;
                        ?>
                    </p>
                </td>
                <td>อุปกรณืที่ติดเครื่องมา</td>
                <td>
                    <p style="text-decoration: underline;">
                        <?php
                        $str_accessory = '';
                        $sql_accessory = "SELECT * FROM in_repair_accessory ir_a";
                        $sql_accessory .= " JOIN accessory a ON a.acc_id = ir_a.acc_id";
                        $sql_accessory .= " WHERE inrep_id = " . $repair['inrep_id'];
                        $query_accessory = mysql_query($sql_accessory) or die(mysql_error());
                        while ($accessory = mysql_fetch_array($query_accessory)) {
                            if (empty($str_problem)) {
                                $str_accessory .= ' # ' . $accessory['acc_name'];
                            } else {
                                $str_accessory .= ' # ' . $accessory['acc_name'];
                            }
                            $str_accessory .= ' <br/> ';
                        }
                        echo $str_accessory;
                        ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td>รายละเอียดอื่นๆ</td>
                <td colspan="3"><p style="text-decoration: underline;"><?= $repair['inrep_remark'] ?></p></td>
            </tr>
            <tr>              
                <td>ประเมิน</td>
                <td><p style="text-decoration: underline;"><?= $repair['rep_estimate_status'] ?></p></td>
                <td>ราคาซ่อม</td>
                <td><p style="text-decoration: underline;"><?= $repair['rep_estimate_price'] ?></p></td>
            </tr>
            <tr>              
                <td>หมายเหตุ</td>
                <td colspan="3"><p style="text-decoration: underline;"><?= $repair['rep_estimate_remark'] ?></p></td>
            </tr>
            <tr>              
                <td>สถานะการซ่อม</td>
                <td><p style="text-decoration: underline;"><?= $repair['inrep_status'] ?></p></td>
                <td></td>
                <td></td>
            </tr>
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
    $mpdf->Output('ข้อมูลใบซ่อม เลขที่ ' . $repair['inrep_code'] . '.pdf', 'D');
}
?>