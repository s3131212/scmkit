<?php
class User_Model {
    public function get_data($id){
        $res = $GLOBALS['db']->select($_SESSION["permission"], array("id" => $_SESSION["login_id"]));
        if(checkpermission(array("student"))){
	        $classname = $GLOBALS['db']->select("class", array("id" => $_SESSION["class"]));
	        return array("name"=>$res[0]["name"],"login_name"=>$res[0]["login_name"],"login_name"=>$res[0]["login_name"],"address"=>$res[0]["address"],"phone"=>$res[0]["phone"],"personalid"=>$res[0]["personalid"],"academic_year"=>$res[0]["academic_year"],"email"=>$res[0]["email"],"class"=>$classname[0]["grade"]."年".$classname[0]["name"]."班","reward"=>$this->ger_incentive(),"leave"=>$this->ger_leave($leave),"id"=>$id);
	    }elseif(checkpermission(array("teacher"))){
	    	return array("name"=>$res[0]["name"],"login_name"=>$res[0]["login_name"],"address"=>$res[0]["address"],"phone"=>$res[0]["phone"],"personalid"=>$res[0]["personalid"],"email"=>$res[0]["email"],"class"=>$this->class_string(),"id"=>$id);
	    }elseif(checkpermission(array("staff"))){
	    	return array("name"=>$res[0]["name"],"login_name"=>$res[0]["login_name"],"address"=>$res[0]["address"],"phone"=>$res[0]["phone"],"id"=>$id);
	    }
    }
    public function set_pass($psd,$id){
        $GLOBALS['db']->update($_SESSION["permission"],array("password"=>md5($psd)),array("id" => $id));
    }
    public function ger_incentive(){
        $data = $GLOBALS['db']->select("incentive", array("studentid" => $_SESSION["login_id"]));
        $output = "";
        foreach ($data as $value) {
            $output .= "<tr><td>".$value["type"]."</td><td>".$value["date"]."</td><td>".$value["notes"]."</td></tr>";
        }
        return $output;
    }
    public function ger_leave(){
        $data = $GLOBALS['db']->select("leave", array("studentid" => $_SESSION["login_id"]));
        $output = "";
        foreach ($data as $value) {
            $output .= "<tr><td>".$value["type"]."</td><td>共".$value["lessons"]."節</td><td>".$value["date"]."</td><td>".$value["reason"]."</td></tr>";
        }
        return $output;
    }
}