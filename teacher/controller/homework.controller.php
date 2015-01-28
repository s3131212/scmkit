<?php
class Homework_Controller {
    public function homework_list(){
        $table = "";
        $model = new Homework_Model;
        foreach($model->homework_list() as $d){
            $res = $model->get_handed_student_num($d["id"]);
            $table .="<tr>
            <td>". $d['name'] ."</td>
            <td>". $d['start_date'] ."</td>
            <td>". $d['end_date'] ."</td>";
            if(!$this->date_check("20".date("y/m/d"),$d["start_date"],">") || !$this->date_check("20".date("y/m/d"),$d["end_date"],"<")){
                $table .= "<td>作業尚未開始或已經過期</td>";
            }else{
                $table .= "<td>作業進行中</td>";
            }
            $table .= "<td>".$res[1]." / ".$res[0]."</td>
            <td><a href=\"homework_view.php?id=". $d['id'] ."\" class=\"btn link\"><button>詳細資料</button></a></td>
            </tr>";
        }
        echo View::call_view("Homework",array("data"=>$table));
    }

    public function homework_view($id){
        $model = new Homework_Model;
        $temp = false;
        foreach ($model->homework_list() as $val) {
            if ($val['id'] == $id) {
                $temp = true;
                break;
            }
        }
        if(!$temp){
            header("Location:homework.php");
            exit();
        }
        $res = $model->get_data($id);
        $num = $model->get_handed_student_num($id);
        if(!empty($model->homework_user_upload($id))){
            $table = "<table class='share_table'><thead><td>上傳學生</td><td>檔案名稱</td><td>上傳時間</td><td>下載</td></thead>";
            foreach($model->homework_user_upload($id) as $d){
                $stu = $model->get_student($d["upload_student"]);
                $table .="<tr><td>".$stu["name"]."</td>
                <td>". $d['filename'] ."</td>
                <td>". $d['upload_time'] ."</td>
                <td><a href=\"homework_download.php?id=". $d['id'] ."\" class=\"btn link\"><button>下載</button></a></td>
                </tr>";
            }
            echo View::call_view("Homework_view",array("id"=>$id,"name"=>$res["name"],"start_date"=>$res["start_date"],"end_date"=>$res["end_date"],"description"=>$res["description"],"data"=>$table,"num"=>$num[1]." / ".$num[0]));
        }else{
            echo View::call_view("Homework_view",array("id"=>$id,"name"=>$res["name"],"start_date"=>$res["start_date"],"end_date"=>$res["end_date"],"description"=>$res["description"],"data"=>"","num"=>$num[1]." / ".$num[0]));
        }
    }
    public function new_homework($name,$start_date,$end_date,$description,$class){
        $model = new Homework_Model;
        $class_string = ",";
        foreach ($class as $value) {
            $class_string .= $value . ",";
        }
        return $model->new_homework($name,$start_date,$end_date,$description,$class_string);
    }
    public function hdownload($id,$class_array){
        $model = new Homework_Model;
        $stu = $model->get_class($id);
        $res = $model->get_data($id);
        if(!in_array($stu, $class_array)){
            header("location:../");
            exit();
        }
        header('Content-Disposition: attachment; filename='.$res["filename"]);
        $passphrase = $res["password"];
        $iv = substr(md5("\x1B\x3C\x58".$passphrase, true), 0, 8);
        $key = substr(md5("\x2D\xFC\xD8".$passphrase, true) .
        md5("\x2D\xFC\xD9".$passphrase, true), 0, 24);
        $opts = array('iv'=>$iv, 'key'=>$key);
        $fp = fopen('../studentupload/'.$res["realpath"].'.data', 'rb');
        stream_filter_append($fp, 'mdecrypt.rijndael-256', STREAM_FILTER_READ, $opts);
        fpassthru($fp);
        return false;
    }

    public function new_homework_form(){
        $model = new Homework_Model;
        $option = "";
        foreach($_SESSION["class"] as $value) {
            $classname = $model->get_class_id($value);
            $option .= "<option value='".$value."'>".$classname["grade"]."年".$classname["name"]."班</option>";
        }
        echo View::call_view("New_homework",array("option"=>$option,"date"=>"20".date("y/m/d")));
    }

    public function modify_homework_form($id){
        $model = new Homework_Model;
        $option = "";
        $res = $model->get_data($id);
        $class = explode(",",$res["class"]);
        foreach($_SESSION["class"] as $value) {
            $classname = $model->get_class_id($value);
            if(in_array($value,$class)) $h="selected"; else $h="";
            $option .= "<option value='".$value."' ".$h." >".$classname["grade"]."年".$classname["name"]."班</option>";
        }
        echo View::call_view("Modify_homework",array("option"=>$option,"start_date"=>$res["start_date"],"end_date"=>$res["end_date"],"name"=>$res["name"],"description"=>$res["description"],"id"=>$id));
    }
    public function modify_homework($name,$start_date,$end_date,$description,$class,$id){
        $model = new Homework_Model;
        $class_string = ",";
        foreach ($class as $value) {
            $class_string .= $value . ",";
        }
        $model->modify_homework($name,$start_date,$end_date,$description,$class_string,$id);
        header("Location:modify_homework.php?id=".$id."&s=1");
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