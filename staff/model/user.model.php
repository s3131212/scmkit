<?php
class User_Model {
    public function get_data($id){
        $res = $GLOBALS['db']->select("staff", array("id" => $_SESSION["login_id"]));
        return array("name"=>$res[0]["name"],"login_name"=>$res[0]["login_name"],"address"=>$res[0]["address"],"phone"=>$res[0]["phone"],"id"=>$id);
    }
    public function set_pass($psd,$id){
        $GLOBALS['db']->update('staff',array("password"=>md5($psd)),array("id" => $id));
    }
}