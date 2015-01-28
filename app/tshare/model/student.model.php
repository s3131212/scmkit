<?php
class Tshare_Model {
    public function get_list($id=0){
        if($id == 0) $data = $GLOBALS['db']->select("teacher_share",array("view_permission"=>"%,".$_SESSION["class"].",%"),'','',true);
        if($id != 0) $data = $GLOBALS['db']->select("teacher_share",array("id"=>$id,"view_permission"=>"%,".$_SESSION["class"].",%"),'','',true);
        return $data;
    }

    public function get_uploader($id,$is_staff){
        if($is_staff == 0) $teacher = $GLOBALS['db']->select("teacher", array("id" => $id));
        else $teacher = $GLOBALS['db']->select("staff", array("id" => $id));
        return $teacher[0]["name"];
    }
}