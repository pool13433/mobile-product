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

switch ($_GET['method']) {
    case 'create':
        $repair_id = $_POST['input-id'];
        $repair_code = $_POST['input-repair_code'];
        $repair_createdate = $_POST['input-createdate'];
        $fname = $_POST['input-fname'];
        $lname = $_POST['input-lname'];
        $idcard = $_POST['input-idcard'];
        $address = $_POST['input-address'];
        $brand = $_POST['combo-brand'];
        $model = $_POST['combo-model'];
        $repair_emi = $_POST['input-emi'];
        $color = $_POST['combo-color'];

        $accessory = [];
        $accessory = $_POST['checkbox-accessory'];
        $accessory_other = $_POST['input-accessory_other'];

        $proble = [];
        $proble = $_POST['checkbox-problem'];
        $proble_other = $_POST['input-problem_other'];

        $repair_remark = $_POST['input-remark'];
        $repair_getdate = $_POST['input-getdate'];
        $per_id = $_POST['input-per_id'];
        $repair_status = '0';
        //####################### manage person #############
        $sql_person = "SELECT * FROM person WHERE per_idcard = '$idcard'";
        $query_person = mysql_query($sql_person) or die(mysql_error());
        $row_person = mysql_num_rows($query_person);
        if ($row_person == 0):
            $sql_insert_person = " INSERT INTO `person`(";
            $sql_insert_person .= "  `per_fname`, `per_lname`,";
            $sql_insert_person .= " `per_username`, `per_password`, ";
            $sql_insert_person .= " `per_idcard`, `pre_address`,";
            $sql_insert_person .= " `per_mobile`, `per_email`, ";
            $sql_insert_person .= " `per_status`) VALUES (";
            $sql_insert_person .= " '$fname','$lname',";
            $sql_insert_person .= " '','',";
            $sql_insert_person .= " '$idcard','$address',";
            $sql_insert_person .= " '','',";
            $sql_insert_person .= " 0";
            $sql_insert_person .= " )";
            $query_insert_person = mysql_query($sql_insert_person) or die(mysql_error());
        endif;
        //####################### manage person #############
        //####################### manage repair #############
        if (empty($_POST['input-id'])): // insert 
            $sql = " INSERT INTO `in_repair`(";
            $sql .= "  `inrep_code`, `inrep_createdate`,";
            $sql .= " `inrep_getdate`, `inrep_remark`,";
            $sql .= " `bra_id`, `mod_id`, `inrep_emi`, `col_id`,";
            $sql .= " `inrep_createby`, `inrep_updatedate`, ";
            $sql .= " `inrep_updateby`, `inrep_status`) VALUES (";
            $sql .= " '$repair_code','" . change_dateDMY_TO_YMD($repair_createdate) . "',";
            $sql .= " '" . change_dateDMY_TO_YMD($repair_getdate) . "','$repair_remark',";
            $sql .= " $brand,$model,'$repair_emi',$color,";
            $sql .= " $ses_id,NOW(),$ses_id,$repair_status";
            $sql .= " )";
        else: // update
            $sql = " UPDATE `in_repair` SET";
            $sql .= " `inrep_code`='$repair_code',";
            $sql .= " `inrep_createdate`='$repair_createdate',";
            $sql .= " `inrep_getdate`='$repair_getdate',";
            $sql .= " `inrep_remark`='$repair_remark',";
            $sql .= " `bra_id`=$brand,";
            $sql .= " `mod_id`=$model,";
            $sql .= " `inrep_emi`='$repair_emi',";
            $sql .= " `col_id`=$color,";
            $sql .= " `inrep_createby`=$ses_id,";
            $sql .= " `inrep_updatedate`=NOW(),";
            $sql .= " `inrep_updateby`=$ses_id,";
            $sql .= " `inrep_status`= $repair_status";
            $sql .= " WHERE inrep_id = $id";
        endif;
        //####################### manage repair #############
        $query_repair = mysql_query($sql) or die(mysql_error());
        $insert_repair_id = mysql_insert_id();
        if ($query_repair):

            // ################### accessory #############
            for ($i = 0; $i < count($accessory); $i++):
                $accessory_id = $accessory[$i];
                $sql_accessory = " INSERT INTO `in_repair_accessory`(";
                $sql_accessory .= "  `acc_id`, `inrep_id`) VALUES (";
                $sql_accessory .= " $accessory_id,$insert_repair_id";
                $sql_accessory .= " )";

                $query_accessory = mysql_query($sql_accessory) or die(mysql_error());
            endfor;
            // ################### accessory #############
            // ################### problem #############
            for ($j = 0; $j < count($proble); $j++):
                $problem_id = $proble[$j];
                $sql_problem = " INSERT INTO `in_repair_problem`(";
                $sql_problem .= " `prob_id`, `inrep_id`) VALUES (";
                $sql_problem .= " $problem_id,$insert_repair_id";
                $sql_problem .= " )";
                $query_problem = mysql_query($sql_problem) or die(mysql_error());
            endfor;
            // ################### problem #############

            echo returnJson('success', 'information', 'เพิ่มใบซ่อมเข้าระบบสำเร็จ', 'index.php?page=list-in_repair');
        else:
            exit("ไม่สามารถ เพิ่มใบซ่อมเข้าระบบได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ");
            echo returnJson('danger', 'error', 'ไม่สามารถ เพิ่มใบซ่อมเข้าระบบได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ', '');
        endif;
        break;
    case 'delete':

        break;
    default:
        break;
}

