<?php
class Tshare_Model {
    public function get_list($is_staff,$id = 0){
        if($is_staff == 0) $data = $GLOBALS['db']->select("teacher_share",array("upload_teacher"=>$id));
        if($is_staff == 1) $data = $GLOBALS['db']->select("teacher_share",array("is_staff"=>1));
        return $data;
    }
    public function get_uploader($id){
        $data = $GLOBALS['db']->select("teacher_share",array("id"=>$id));
        return $data[0]["upload_teacher"];
    }
    public function is_staff($id){
        $data = $GLOBALS['db']->select("teacher_share",array("id"=>$id));
        if($data[0]["is_staff"]==1) return true;
        else return false;
    }
    public function get_data($id){
        $data = $GLOBALS['db']->select("teacher_share",array("id"=>$id));
        return $data[0];
    }
    public function get_class($id){
        $data = $GLOBALS['db']->select("class",array("id"=>$id));
        return $data[0];
    }
    public function insert_file($name,$filename,$passphrase,$id,$view_permission_string){
        $GLOBALS['db']->insert(array("filename"=>Security::xss_filter($name),"upload_teacher"=>Security::xss_filter($id),"password"=>$passphrase,"realpath"=>$filename,"view_permission"=>Security::xss_filter($view_permission_string),"is_staff"=>0),"teacher_share");
        $filedata = $GLOBALS['db']->select("teacher_share", array("realpath" => $filename));
        return $filedata[0];
    }
    public function delete_data($id){
        $data = $GLOBALS['db']->delete('teacher_share', array('id' => $id));
        return false;
    }
    public function update_data($view_permission_string,$filename,$id){
        $GLOBALS['db']->update('teacher_share',array("view_permission"=>$view_permission_string,"filename"=>Security::xss_filter($filename)),array("id"=>Security::xss_filter($id))); 
        return false;
    }
}