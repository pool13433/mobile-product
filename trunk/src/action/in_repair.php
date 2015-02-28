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
$message = '';
switch ($_GET['method']) {
    case 'create':
        $person_insert_id = '';
        $repair_id = $_POST['input-id'];
        $repair_code = $_POST['input-repair_code'];
        $repair_createdate = $_POST['input-createdate'];
        $fname = $_POST['input-fname'];
        $lname = $_POST['input-lname'];
        $person_id = $_POST['input-person_id'];
        $idcard = $_POST['input-idcard'];
        $mobile = $_POST['input-mobile'];
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
        if ($row_person == 0) { // insert new person 
            $sql_insert_person = " INSERT INTO `person`(";
            $sql_insert_person .= "  `per_fname`, `per_lname`,";
            $sql_insert_person .= " `per_username`, `per_password`, ";
            $sql_insert_person .= " `per_idcard`, `per_address`,";
            $sql_insert_person .= " `per_mobile`, `per_email`, ";
            $sql_insert_person .= " `per_status`) VALUES (";
            $sql_insert_person .= " '$fname','$lname',";
            $sql_insert_person .= " '','',";
            $sql_insert_person .= " '$idcard','$address',";
            $sql_insert_person .= " '','',";
            $sql_insert_person .= " ".CUSTOMER_STATUS;
            $sql_insert_person .= " )";
            $query_insert_person = mysql_query($sql_insert_person) or die(mysql_error());
            $person_insert_id = mysql_insert_id();
            if (!$query_insert_person) {
                exit("insert person fail");
            }
        } else { // update person 
            $sql_update_person = " UPDATE `person` SET";
            //$sql_update_person .= " `per_id`=[value-1],";
            $sql_update_person .= " `per_fname`='$fname',";
            $sql_update_person .= " `per_lname`='$lname',";
            //$sql_update_person .= " `per_username`=[value-4],";
            //$sql_update_person .= " `per_password`=[value-5],";
            $sql_update_person .= " `per_idcard`='$idcard',";
            $sql_update_person .= " `per_address`='$address',";
            $sql_update_person .= " `per_mobile`='$mobile',";
            $sql_update_person .= " `per_email`=''";
            //$sql_update_person .= " `per_status`=[value-10]";
            $sql_update_person .= " WHERE `per_idcard`='$idcard'";
            $query_update_person = mysql_query($sql_update_person) or die(mysql_error());
            if (!$query_update_person):
                exit("update person fail");
            endif;
        }
        if (empty($person_id)) {
            $person_id = $person_insert_id;
        }
        //####################### manage person #############
        //####################### manage repair #############
        if (empty($_POST['input-id'])): // insert 
            $sql = " INSERT INTO `in_repair`(";
            $sql .= "  `inrep_code`,`per_id`, `inrep_createdate`,";
            $sql .= " `inrep_getdate`,`inrep_realdate`, `inrep_remark`,`inrep_accessory_other`,`inrep_problem_other`,";
            $sql .= " `bra_id`, `mod_id`, `inrep_emi`, `col_id`,";
            $sql .= " `inrep_createby`, `inrep_updatedate`, ";
            $sql .= " `inrep_updateby`, `inrep_status`) VALUES (";
            $sql .= " '$repair_code','$person_id',STR_TO_DATE('$repair_createdate','%d-%m-%Y'),";
            $sql .= " STR_TO_DATE('$repair_getdate','%d-%m-%Y'),NOW(),'$repair_remark','$accessory_other','$proble_other',";
            $sql .= " $brand,$model,'$repair_emi',$color,";
            $sql .= " $ses_id,NOW(),$ses_id,$repair_status";
            $sql .= " )";
            $message = 'เพิ่มใบซ่อมเข้าระบบสำเร็จ';
        else: // update
            $sql = " UPDATE `in_repair` SET";
            $sql .= " `inrep_code`='$repair_code',";
            $sql .= " `per_id` = '$person_id',";
            $sql .= " `inrep_createdate`=STR_TO_DATE('$repair_createdate','%d-%m-%Y'),";
            $sql .= " `inrep_getdate`=STR_TO_DATE('$repair_getdate','%d-%m-%Y'),";
            $sql .= " `inrep_realdate` = NOW(), ";
            $sql .= " `inrep_remark`='$repair_remark',";
            $sql .= " `inrep_accessory_other` = '$accessory_other',";
            $sql .= " `inrep_problem_other` = '$proble_other',";
            $sql .= " `bra_id`=$brand,";
            $sql .= " `mod_id`=$model,";
            $sql .= " `inrep_emi`='$repair_emi',";
            $sql .= " `col_id`=$color,";
            $sql .= " `inrep_createby`=$ses_id,";
            $sql .= " `inrep_updatedate`=NOW(),";
            $sql .= " `inrep_updateby`=$ses_id,";
            $sql .= " `inrep_status`= $repair_status";
            $sql .= " WHERE inrep_id = $repair_id";
            $message = 'แก้ไขใบซ่อมเข้าระบบสำเร็จ';
        endif;
        //####################### manage repair #############
        $query_repair = mysql_query($sql) or die(mysql_error() . "sql :==" . $sql);
        $insert_repair_id = mysql_insert_id();
        if (empty($insert_repair_id)):
            $insert_repair_id = $repair_id;
        endif;
        if ($query_repair):

            // ################### accessory #############
            if (!empty($_POST['input-id'])):
                $query_accessory = mysql_query("DELETE FROM in_repair_accessory WHERE inrep_id =$repair_id") or die(mysql_error());
                if (!$query_accessory):
                    exit("ลบข้อมูลไม่สำเร็จ");
                endif;
            endif;
            for ($i = 0; $i < count($accessory); $i++):
                $accessory_id = $accessory[$i];
                $sql_accessory = " INSERT INTO `in_repair_accessory`(";
                $sql_accessory .= "  `acc_id`, `inrepacc_check`,`inrep_id`) VALUES (";
                $sql_accessory .= " $accessory_id,0,$insert_repair_id";
                $sql_accessory .= " )";

                $query_accessory = mysql_query($sql_accessory) or die(mysql_error());
            endfor;
            // ################### accessory #############
            // ################### problem #############
            if (!empty($_POST['input-id'])):
                $query_problem = mysql_query("DELETE FROM in_repair_problem WHERE inrep_id = $repair_id") or die(mysql_error());
                if (!$query_problem):
                    exit("ลบข้อมูลไม่สำเร็จ");
                endif;
            endif;
            for ($j = 0; $j < count($proble); $j++):
                $problem_id = $proble[$j];
                $sql_problem = " INSERT INTO `in_repair_problem`(";
                $sql_problem .= " `prob_id`, `inrep_id`) VALUES (";
                $sql_problem .= " $problem_id,$insert_repair_id";
                $sql_problem .= " )";
                $query_problem = mysql_query($sql_problem) or die(mysql_error());
            endfor;
            // ################### problem #############

            echo returnJson('success', 'information', $message, 'index.php?page=list-repair_in');
        else:
            exit("ไม่สามารถ เพิ่มใบซ่อมเข้าระบบได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ");
            echo returnJson('danger', 'error', 'ไม่สามารถ เพิ่มใบซ่อมเข้าระบบได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ', '');
        endif;
        break;
    case 'delete':
        $repair_id = $_POST['id'];
        $query = mysql_query("DELETE FROM in_repair WHERE inrep_id = $repair_id") or die(mysql_error());
        if ($query) {
            //############# remove chidren ########
            $query_accessory = mysql_query("DELETE FROM in_repair_accessory WHERE inrep_id =$repair_id") or die(mysql_error());
            if (!$query_accessory):
                exit("ลบข้อมูลไม่สำเร็จ");
            endif;
            $query_problem = mysql_query("DELETE FROM in_repair_problem WHERE inrep_id = $repair_id") or die(mysql_error());
            if (!$query_problem):
                exit("ลบข้อมูลไม่สำเร็จ");
            endif;
            //############# remove chidren ########
            echo returnJson('success', 'information', 'ลบสำเร็จ', '');
        }
        break;
    case 'get_accessory_is_check':
        $repair_id = $_POST['repair_id'];
        $accessory_id = $_POST['accessory_id'];
        $sql = "SELECT * FROM in_repair_accessory WHERE inrep_id = $repair_id AND acc_id = $accessory_id";
        $query = mysql_query($sql) or die(mysql_error());
        $row = mysql_num_rows($query);
        if ($row > 0):
            echo json_encode(array('status' => true));
        endif;
        break;
    case 'get_problem_is_check':
        $repair_id = $_POST['repair_id'];
        $problem_id = $_POST['problem_id'];
        $sql = "SELECT * FROM in_repair_problem WHERE inrep_id = $repair_id AND prob_id = $problem_id";
        $query = mysql_query($sql) or die(mysql_error());
        $row = mysql_num_rows($query);
        if ($row > 0):
            echo json_encode(array('status' => true));
        endif;
        break;
    
    default:
        break;
}

