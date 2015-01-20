<?php
class Staff_Model {
	public function list_staff(){
		$res = $GLOBALS['db']->select("staff");
		return $res;
	}
	public function update_info($name,$login_name,$address,$phone,$id){
    	$GLOBALS['db']->update('staff',array("name"=>View::xss_filter($name),"login_name"=>View::xss_filter($login_name),"address"=>View::xss_filter($address),"phone"=>View::xss_filter($phone)),array("id"=>$id));
    	return false;
	}
    public function get_info($id){
        $res = $GLOBALS['db']->select("staff",array("id"=>$id));
        return $res[0];
    }
	public function new_staff($name,$id,$login_name,$psd){
		$namecheck = $GLOBALS['db']->ExecuteSQL(sprintf("SELECT count(*) AS `count`  FROM `staff` WHERE `login_name` = '%s'",$login_name));
    	if($namecheck[0]["count"] > 0){
        	$alert = '<div class="alert alert-danger" style="margin-top:30px;">此帳號已存在</div>';
    	}else{
    		$GLOBALS['db']->insert(array("name"=>View::xss_filter($name),"id"=>$id,"login_name"=>View::xss_filter($login_name),"password"=>md5($psd)),"staff");
    		$alert = '<div class="alert alert-success" style="margin-top:30px;">新增完成</div>';
		}
		return $alert;
	}
    public function delete_staff($id){
        $GLOBALS['db']->delete('staff', array('id' => $id));
        foreach($GLOBALS['db']->select("teacher_share",array("upload_teacher" => $id)) as $d){
            @unlink("../../teacherupload/".$d["realpath"].".data");
            $GLOBALS['db']->delete('teacher_share', array('id' => $d["id"]));
        }
        return false;
    }
}