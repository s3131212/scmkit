<?php
//require_once (dirname(__FILE__).'/excelreader/reader.php');
class Student_Model {
    public function get_class($id){
        $classname = $GLOBALS['db']->Select("class", array("id" => $id));
        return $classname[0];
    }

    public function get_class_with_name($grade,$name){
        $class = $GLOBALS['db']->select("class", array("grade" => $grade,"name" => $name));
        if($class[0]["id"]!=null) return $class[0]["id"];
        else return "0";
    }

    public function list_student($dataperpage,$nowpage,$offset,$id){
        $data = array();
        foreach($GLOBALS['db']->select("student",array("class" => $id),'',$offset) as $d){ 
            $data[] = array("name"=>$d["name"],"login_name"=>$d["login_name"],"id"=>$d["id"]);
        }
        $pagecheck = $GLOBALS['db']->ExecuteSQL(sprintf("SELECT count(*) AS `count`  FROM `student` WHERE `class` = '%s'",$id));
        return array($data,$pagecheck[0]["count"]); //array(資料 , 資料量)
    }

    public function get_info($id){
        $res = $GLOBALS['db']->select("student",array("id" => $id));
        return $res[0];
    }

    public function update_info($name,$login_name,$address,$phone,$personalid,$class_grade,$class_name,$academic_year,$incentive,$id){
        $class = $this->get_class_with_name($class_grade,$class_name);
        $GLOBALS['db']->update('student',array("name"=>View::xss_filter($name),"login_name"=>View::xss_filter($login_name),"address"=>View::xss_filter($address),"phone"=>View::xss_filter($phone),"personalid"=>View::xss_filter($personalid),"academic_year"=>View::xss_filter($academic_year),"class"=>View::xss_filter($class),"incentive"=>$incentive),array("id"=>$id));
    }

    public function new_leave($id,$affairs_date,$affairs_num,$sick_date,$sick_num,$bereavement_date,$bereavement_num,$public_date,$public_num,$truancy_date,$truancy_num){
        $model = new Student_Model;
        $res = $GLOBALS['db']->select("student", array("id" => $id));
        $leave = json_decode($res[0]["leave"],true);
        if($affairs_date != null && $affairs_num != null) $leave[0]["affairs"] = $leave[0]["affairs"] + array($affairs_date => $affairs_num);
        if($sick_date != null && $sick_num != null) $leave[0]["sick"] = $leave[0]["sick"] + array($sick_date=>$sick_num);
        if($bereavement_date != null && $bereavement_num != null) $leave[0]["bereavement"] = $leave[0]["affairs"] + array($bereavement_date => $abereavement_num);
        if($public_date != null && $public_num != null) $leave[0]["public"] = $leave[0]["public"] + array($public_date => $public_num);
        if($truancy_date != null && $truancy_num != null) $leave[0]["truancy"] = $leave[0]["truancy"] + array($truancy_date => $truancy_num);
        $json=json_encode($leave);
        $GLOBALS['db']->update('student',array("leave"=>$json),array("id"=>$id));
        return false;
    }
}