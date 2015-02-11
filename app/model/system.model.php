<?php 
class System_Model {
    public function get_data(){
        $mail=$this->infoget("mail");
        $mail_auth=$this->infoget("mail_auth");
        $mail_select = ($mail == "true") ? "checked" : "";
        $mail_auth_select = ($mail_auth == "true") ? "checked" : "";
        return array(
            "announcement"=>$this->infoget("announcement"),
            "schoolname"=>$this->infoget("schoolname"),
            "seat_default_width"=>$this->infoget("seat_default_width"),
            "seat_default_height"=>$this->infoget("seat_default_height"),
            "lessons_per_day"=>$this->infoget("lessons_per_day"),
            "mail_server"=>$this->infoget("mail_server"),
            "mail_auth_select"=>$mail_auth_select,
            "mail_select"=>$mail_select,
            "mail"=>$this->infoget("mail"),
            "mail_auth"=>$this->infoget("mail_auth")
        );
    }
    public function update_setting(){
        $model = new System_Model;
        $GLOBALS['db']->update('setting',array("value"=>htmlspecialchars($_POST["schoolname"])),array("name"=>"schoolname"));
        $GLOBALS['db']->update('setting',array("value"=>htmlspecialchars($_POST["announcement"])),array("name"=>"announcement"));
        $GLOBALS['db']->update('setting',array("value"=>htmlspecialchars($_POST["seat_default_width"])),array("name"=>"seat_default_width"));
        $GLOBALS['db']->update('setting',array("value"=>htmlspecialchars($_POST["seat_default_height"])),array("name"=>"seat_default_height"));
        $GLOBALS['db']->update('setting',array("value"=>htmlspecialchars($_POST["lessons_per_day"])),array("name"=>"lessons_per_day"));
        $GLOBALS['db']->update('setting',array("value"=>htmlspecialchars($_POST["mail_server"])),array("name"=>"mail_server"));
        $GLOBALS['db']->update('setting',array("value"=>htmlspecialchars($_POST["mail_port"])),array("name"=>"mail_port"));
        $GLOBALS['db']->update('setting',array("value"=>htmlspecialchars($_POST["mail_user"])),array("name"=>"mail_user"));
        $GLOBALS['db']->update('setting',array("value"=>htmlspecialchars($_POST["mail_psd"])),array("name"=>"mail_psd"));
        $mail = ($_POST["mail"] == "true") ? "true" : "false";
        $GLOBALS['db']->update('setting',array("value"=>$mail),array("name"=>"mail"));
        $mail_auth = ($_POST["mail_auth"] == "true") ? "true" : "false";
        $GLOBALS['db']->update('setting',array("value"=>$mail_auth),array("name"=>"mail_auth"));
    }
    private function infoget($name){
        $data = $GLOBALS['db']->select("setting", array("name" => $name));
        return $data[0]["value"];
    }
}