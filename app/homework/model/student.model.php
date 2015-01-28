<?php
class Homework_Model {
    public function homework_list(){
        $array = array();
        foreach($GLOBALS['db']->Select("homework", array("class"=>"%,".$_SESSION["class"].",%"), '', '', true) as $d){
            $array[] = array("id"=>$d['id'],"name"=>$d['name'],"start_date"=>$d["start_date"],"end_date"=>$d['end_date']);
        }
        return $array;
    }

	public function insert_file($name,$filename,$passphrase,$user_id,$id){
        $GLOBALS['db']->insert(array("filename"=>Template::xss_filter($name),"upload_student"=>Template::xss_filter($user_id),"homework_id"=>$id,"password"=>$passphrase,"realpath"=>$filename),"homework_upload");
        $filedata = $GLOBALS['db']->select("homework_upload", array("realpath" => $filename));
		return $filedata[0];
	}

    public function homework_user_upload($h_id){
        $array = array();
        foreach($GLOBALS['db']->select("homework_upload",array("upload_student"=>$_SESSION["login_id"],"homework_id"=>$h_id)) as $d){
            $array[] = array("id"=>$d['id'],"filename"=>$d['filename'],"upload_time"=>$d["upload_time"]);
        }
        return $array;
    }

    public function get_data($id){
        $res = $GLOBALS['db']->select("homework",array("id"=>$id));
        return $res[0];
    }

    public function get_file_data($id){
        $res = $GLOBALS['db']->select("homework_upload",array("id"=>$id));
        return $res[0];
    }

    public function get_teacher($id){
        $res = $GLOBALS['db']->select("teacher",array("id"=>$id));
        return $res[0];
    }

	private function sizecount($size){
  		if ($size<1000) {
    		return $size."B";
  		}elseif ($size>=1000&&$size<1000000) {
    		return round(($size/1000),2).'KB';
  		}elseif ($size>=1000000&&$size<1000000000) {
    		return round(($size/1000000),2).'MB';
  		}elseif ($size>=1000000000&&$size<1000000000000) {
    		return round(($size/1000000000),2).'GB';
  		}
	}
}