<?php
require_once (dirname(dirname(dirname(__FILE__))).'/core/excelreader/reader.php');
class Student_Model {

    public function get_class_list(){
        $res = $GLOBALS['db']->select("class");
        return $res;
    }

    public function get_class($id){
        $res = $GLOBALS['db']->select("class",array("id"=>$id));
        return $res[0];
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

    public function get_leave_data($id){
        return $GLOBALS['db']->select("leave", array("studentid" => $id));
    }

    public function get_incentive_data($id){
        return $GLOBALS['db']->select("incentive", array("studentid" => $id));
    }

    public function get_leave_data_by_id($id){
        $data = $GLOBALS['db']->select("leave", array("id" => $id));
        return $data[0];
    }

    public function get_incentive_data_by_id($id){
        $data = $GLOBALS['db']->select("incentive", array("id" => $id));
        return $data[0];
    }

    public function update_info($name,$login_name,$address,$phone,$personalid,$class_grade,$class_name,$academic_year,$email,$id){
        $class = $this->get_class_with_name($class_grade,$class_name);
        $GLOBALS['db']->update('student',array("name"=>Security::xss_filter($name),"login_name"=>Security::xss_filter($login_name),"address"=>Security::xss_filter($address),"phone"=>Security::xss_filter($phone),"personalid"=>Security::xss_filter($personalid),"academic_year"=>Security::xss_filter($academic_year),"class"=>Security::xss_filter($class),"email"=>Security::xss_filter($email)),array("id"=>$id));
    }

    public function modify_leave($id,$mode,$data){
        if($mode == "new"){
            $GLOBALS['db']->insert(array("studentid"=>Security::xss_filter($data["studentid"]),"type"=>Security::xss_filter($data["type"]),"lessons"=>Security::xss_filter($data["lessons"]),"reason"=>Security::xss_filter($data["reason"],true),"date"=>Security::xss_filter($data["date"])),"leave");
        }elseif($mode == "modify"){
            $GLOBALS['db']->update("leave",array("type"=>Security::xss_filter($data["type"]),"lessons"=>Security::xss_filter($data["lessons"]),"reason"=>Security::xss_filter($data["reason"],true)),array("id"=>$id));
        }elseif($mode == "delete"){
            $GLOBALS['db']->delete('leave', array('id' => $id));
        }
    }

    public function modify_incentive($id,$mode,$data){
        if($mode == "new"){
            $GLOBALS['db']->insert(array("studentid"=>Security::xss_filter($data["studentid"]),"type"=>Security::xss_filter($data["type"]),"notes"=>Security::xss_filter($data["notes"],true),"date"=>Security::xss_filter($data["date"])),"incentive");
        }elseif($mode == "modify"){
            $GLOBALS['db']->update("incentive",array("type"=>Security::xss_filter($data["type"]),"notes"=>Security::xss_filter($data["notes"],true),"date"=>Security::xss_filter($data["date"])),array("id"=>$id));
        }elseif($mode == "delete"){
            $GLOBALS['db']->delete('incentive', array('id' => $id));
        }
    }

    public function new_student($name,$id,$login_name,$academic_year,$password,$class_grade,$class_name,$address,$phone,$personalid){
        $class=$GLOBALS['db']->select("class", array("grade" => $class_grade,"name" => $class_name));
        $GLOBALS['db']->insert(array("name"=>Security::xss_filter($name),"id"=>Security::xss_filter($id),"login_name"=>Security::xss_filter($login_name),"academic_year"=>Security::xss_filter($academic_year),"password"=>md5($password),"class"=>$class[0]["id"],"address"=>Security::xss_filter($address),"phone"=>Security::xss_filter($phone),"personalid"=>Security::xss_filter($personalid),"incentive"=>'[{"firstleveldemerit":"0","secondleveldemerit":"0","warning":"0","firstcredit":"0","secondcredit":"0","reward":"0"}]'),"student");

    }

    public function delete_student($id){
        $GLOBALS['db']->delete('student', array('id' => $id));
        foreach($GLOBALS['db']->select("student_homework",array("upload_student" => $id)) as $d){
            @unlink("../../studentupload/".$d["realpath"].".data");
            $GLOBALS['db']->delete('student_homework', array('id' => $d["id"]));
        }
        return false;
    }
}