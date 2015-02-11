<?php
class User_Model {
    public function get_data($id){
        $res = $GLOBALS['db']->select($_SESSION["permission"], array("id" => $_SESSION["login_id"]));
        if(checkpermission(array("student"))){
	        $classname = $GLOBALS['db']->select("class", array("id" => $_SESSION["class"]));
	        $incentive = json_decode($res[0]["incentive"]);
	        $leave = json_decode($res[0]["leave"]);
	        return array("name"=>$res[0]["name"],"login_name"=>$res[0]["login_name"],"login_name"=>$res[0]["login_name"],"address"=>$res[0]["address"],"phone"=>$res[0]["phone"],"personalid"=>$res[0]["personalid"],"academic_year"=>$res[0]["academic_year"],"email"=>$res[0]["email"],"class"=>$classname[0]["grade"]."年".$classname[0]["name"]."班","firstleveldemerit"=>$incentive[0]->firstleveldemerit,"secondleveldemerit"=>$incentive[0]->secondleveldemerit,"warning"=>$incentive[0]->warning,"firstcredit"=>$incentive[0]->firstcredit,"secondcredit"=>$incentive[0]->secondcredit,"reward"=>$incentive[0]->reward,"leave"=>$this->ger_leave($leave),"id"=>$id);
	    }elseif(checkpermission(array("teacher"))){
	    	return array("name"=>$res[0]["name"],"login_name"=>$res[0]["login_name"],"address"=>$res[0]["address"],"phone"=>$res[0]["phone"],"personalid"=>$res[0]["personalid"],"email"=>$res[0]["email"],"class"=>$this->class_string(),"id"=>$id);
	    }elseif(checkpermission(array("staff"))){
	    	return array("name"=>$res[0]["name"],"login_name"=>$res[0]["login_name"],"address"=>$res[0]["address"],"phone"=>$res[0]["phone"],"id"=>$id);
	    }
    }
    public function set_pass($psd,$id){
        $GLOBALS['db']->update($_SESSION["permission"],array("password"=>md5($psd)),array("id" => $id));
    }
    public function ger_leave($data){
        $leave = "事假：";
        if(empty($data[0]->sick)) $leave .= "無";
        else foreach ($data[0]->affairs as $key => $value) $leave .=  $key." -> " . $value ."節&nbsp&nbsp";
        $leave .= "<br />病假：";
        if(empty($data[0]->sick)) $leave .= "無";
        else foreach ($data[0]->sick as $key => $value) $leave .=  $key." -> " . $value ."節&nbsp&nbsp";
        $leave .= "<br />喪假：";
        if(empty($data[0]->bereavement)) $leave .= "無";
        else foreach ($data[0]->bereavement as $key => $value) $leave .=  $key." -> " . $value ."節&nbsp&nbsp";
        $leave .= "<br />公假：";
        if(empty($data[0]->public)) $leave .= "無";
        else foreach ($data[0]->public as $key => $value) $leave .=  $key." -> " . $value ."節&nbsp&nbsp";
        $leave .= "<br />曠課：";
        if(empty($data[0]->truancy)) $leave .= "無";
        else foreach ($data[0]->truancy as $key => $value) $leave .=  $key." -> " . $value ."節&nbsp&nbsp";
        return $leave;
    }
}