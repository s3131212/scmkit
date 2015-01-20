<?php
class Homework_Controller {
    public function homework_list(){
        $table = array();
        $model = new Homework_Model;
        foreach($model->homework_list() as $d){
            if($this->date_check("20".date("y/m/d"),$d["start_date"],">")&&$this->date_check("20".date("y/m/d"),$d["end_date"],"<")){
                $table[] = $d;
            }
        }
        echo Homework_View::homework_list($table);
    }

    public function homework_view($id){
        $model = new Homework_Model;
        $res = $model->get_data($id);
        $te = $model->get_teacher($res["teacher"]);
        $class = explode(",", $res["class"]);
        if(!in_array($_SESSION["class"], $class)){
            header("Location:homework.php");
            exit();
        }
        if(!empty($model->homework_user_upload($id))){
            $table = array();
            foreach($model->homework_user_upload($id) as $d){
                $table[] = $d;
            }
            echo Homework_View::homework_view_id($id,$res["name"],$res["start_date"],$res["end_date"],$res["description"],$te["name"],$table);
        }else{
            echo Homework_View::homework_view_id($id,$res["name"],$res["start_date"],$res["end_date"],$res["description"],$te["name"]);
        }
    }

    public function upload_form($id){
        $model = new Homework_Model;
        $res = $model->get_data($id);
        $class = explode(",", $res["class"]);
        if(!in_array($_SESSION["class"], $class)){
            header("Location:homework.php");
            exit();
        }
        if(!$this->date_check("20".date("y/m/d"),$res["start_date"],">")){
            header("Location:homework.php");
            exit();
        }
        if(!$this->date_check("20".date("y/m/d"),$res["end_date"],"<")){
            header("Location:homework.php");
            exit();
        }
        echo Homework_View::upload_form($id,$res["name"]);
    }

	public function upload_file($file_array,$id){
        $model = new Homework_Model;
        $res = $model->get_data($id);
        $class = explode(",", $res["class"]);
        if(!in_array($_SESSION["class"], $class)){
            header("Location:homework.php");
            exit();
        }
        $table = array();
		$i=count($file_array["file"]["name"]); 
		for ($j=0 ; $j<$i ; $j++){
    		if($file_array['file']['error'][$j]>0){
        		$result="unknow";
    		}
    		$passphrase = sha1(md5(mt_rand() . uniqid()));
    		$filename = sha1(md5(mt_rand() . uniqid()));
    		if ($result!="unknow") {
        		$iv = substr(md5("\x1B\x3C\x58".$passphrase, true), 0, 8);
        		$key = substr(md5("\x2D\xFC\xD8".$passphrase, true) .
        		md5("\x2D\xFC\xD9".$passphrase, true), 0, 24);
        		$opts = array('iv'=>$iv, 'key'=>$key);
        		$fp = fopen($file_array['file']['tmp_name'][$j], 'rb');
                $dest = fopen(dirname(dirname(dirname(dirname(__FILE__)))).'/studentupload/' . $filename . '.data', 'wb');
        		stream_filter_append($dest, 'mcrypt.rijndael-256', STREAM_FILTER_WRITE, $opts);
        		stream_copy_to_stream($fp, $dest);
        		fclose($fp);
        		fclose($dest);
                $filedata = $model->insert_file($file_array['file']['name'][$j],$filename,$passphrase,$_SESSION["login_id"],$id);
        		$result="success";
    		}
   			if ($result=="success") {
        		$size = $this->sizecount($file_array['file']['size'][$j]);
                $table[] = array(Template::xss_filter($file_array['file']['name'][$j]),$size,$filedata["id"],$res["id"],Template::xss_filter($res["name"]),"success");
    		}else{
                $table[] = array("","","","","","error");
            }
		}
		echo Homework_View::upload_file($table);
	}

    public function hdownload($id){
        $model = new Homework_Model;
        $res = $model->get_file_data($id);
        if($_SESSION["login_id"]!=$res["upload_student"]){
            header("location:../");
            exit();
        }
        header('Content-Disposition: attachment; filename='.$res["filename"]);
        $passphrase = $res["password"];
        $iv = substr(md5("\x1B\x3C\x58".$passphrase, true), 0, 8);
        $key = substr(md5("\x2D\xFC\xD8".$passphrase, true) .
        md5("\x2D\xFC\xD9".$passphrase, true), 0, 24);
        $opts = array('iv'=>$iv, 'key'=>$key);
        $fp = fopen(dirname(dirname(dirname(dirname(__FILE__)))).'/studentupload/'.$res["realpath"].'.data', 'rb');
        stream_filter_append($fp, 'mdecrypt.rijndael-256', STREAM_FILTER_READ, $opts);
        fpassthru($fp);
        return false;
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

    private function date_check($now,$date,$com){
        if($com==">"){
            for( $i=0 ; $i<10 ; $i++ ){
                if($now[$i]!="-" && $date[$i]!="-"){
                    if($now[$i]>$date[$i]){
                        return true;
                        break;
                    }
                    if($now[$i]<$date[$i]){
                        return false;
                        break;
                    }
                }
            }
            return true;
        }
        if($com=="<"){
            for( $i=0 ; $i<10 ; $i++ ){
                if($now[$i]!="-" && $date[$i]!="-"){
                    if($now[$i]>$date[$i]){
                        return false;
                        break;
                    };
                    if($now[$i]<$date[$i]){
                        return true;
                        break;
                    };
                }
            }
            return true;
        }
    }
}