<?php
class Homework_Controller {

    public function homework_list(){
        Homework_View::homework_list();
    }

    public function homework_view($id){
        Homework_View::homework_view_by_id($id);
    }
    public function new_homework($name,$start_date,$end_date,$description,$class){
        $model = new Homework_Model;
        $class_string = ",";
        foreach ($class as $value) {
            $class_string .= $value . ",";
        }
        $id = $model->new_homework($name,$start_date,$end_date,$description,$class_string);
        header("Location: view/?id=".$id); 
    }
    public function hdownload($id){
        $model = new Homework_Model;
        $stu = $model->get_class($id);
        $res = $model->get_file_data($id);
        if(!in_array($stu, $_SESSION["class"])){
            header("location: / ");
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

    public function new_homework_form(){
        if(isset($_POST["name"])){
            $this->new_homework($_POST["name"],$_POST["start_date"],$_POST["end_date"],$_POST["description"],$_POST["class"]);
            exit();
        }
        echo Homework_View::new_homework_form();
    }

    public function modify_homework_form($id){
        if(isset($_POST["name"])){
            $this->modify_homework($_POST["name"],$_POST["start_date"],$_POST["end_date"],$_POST["description"],$_POST["class"],$_GET["id"]);
            exit();
        }
        echo Homework_View::modify_homework_form($id);
    }
    public function modify_homework($name,$start_date,$end_date,$description,$class,$id){
        $model = new Homework_Model;
        $class_string = ",";
        foreach ($class as $value) {
            $class_string .= $value . ",";
        }
        $model->modify_homework($name,$start_date,$end_date,$description,$class_string,$id);
        header("Location:../modify/?id=".$id."&s=1");
    }
    public function date_check($now,$date,$com){
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