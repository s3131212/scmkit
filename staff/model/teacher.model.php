<?php
require_once (dirname(dirname(dirname(__FILE__))).'/core/excelreader/reader.php');
class Teacher_Model {
    public function list_teacher($dataperpage,$nowpage,$offset){
        $data = array();
        foreach($GLOBALS['db']->select("teacher",'','',$offset) as $d){ 
            $data[] = array("name"=>$d["name"],"login_name"=>$d["login_name"],"id"=>$d["id"]);
        }
        $pagecheck = $GLOBALS['db']->ExecuteSQL("SELECT count(*) AS `count`  FROM `teacher`");
        return array($data,$pagecheck[0]["count"]); //array(資料 , 資料量)
    }
	public function update_info($name,$login_name,$address,$phone,$email,$class,$personalid,$id){
    	$GLOBALS['db']->update('teacher',array("name"=>View::xss_filter($name),"login_name"=>View::xss_filter($login_name),"address"=>View::xss_filter($address),"phone"=>View::xss_filter($phone),"email"=>View::xss_filter($email),"personalid"=>View::xss_filter($personalid),"class"=>$class),array("id"=>$id));
    	return false;
	}
    public function get_class($id){
        $res = $GLOBALS['db']->select("class",array("id"=>$id));
        return $res[0];
    }
	public function create_class_options(){
		$res = $GLOBALS['db']->select("class");
        return $res;
	}
    public function get_teacher_data($id){
        $res = $GLOBALS['db']->select("teacher",array("id"=>$id));
        return $res[0];
    }
	public function new_teacher($name,$id,$login_name,$email,$class,$psd){
    	$GLOBALS['db']->insert(array("name"=>View::xss_filter($name),"id"=>View::xss_filter($id),"login_name"=>View::xss_filter($login_name),"email"=>View::xss_filter($email),"class"=>$class_string,"password"=>md5($psd)),"teacher");
    	//$alert = '<div class="alert alert-success" style="margin-top:30px;">新增完成</div>';
		//echo json_encode(array(array("content"=>$alert)));
	}
    public function delete_teacher($id){
        $GLOBALS['db']->delete('teacher', array('id' => $id));
        foreach($GLOBALS['db']->select("teacher_share",array("upload_teacher" => $id)) as $d){
            @unlink("../teacherupload/".$d["realpath"].".data");
            $GLOBALS['db']->delete('teacher_share', array('id' => $d["id"]));
        }
        return false;
    }
}