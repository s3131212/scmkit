<?php 
class Tshare_Controller {
	public function tshare_list_table(){
		$table = "";
		$model=new Tshare_Model;
        foreach($model->get_list() as $d){
            $view_permission = explode(",", $d["view_permission"]);
            $view_permission_string = $model->class2string($view_permission);
            $table .= "<tr>
                <td>" . $d['filename'] ."</td>
                <td>" . $d['upload_time'] . "</td>
                <td>" . $view_permission_string . "</td>
                <td><div class=\"btn-group\"><a href=\"download.php?id=". $d['id'] ."\" class=\"btn link\"><button>下載</button></a>";
            if(!checkpermission(array("student"))) $table .= "<a href=\"tshare-modify.php?id=" . $d['id'] . " \" class=\"btn btn-default\"><button>變更</button></a>";
            $table .= "</div></td></tr>";
        }
		echo Template::call_view("tshare",array("data"=>$table));
	}

	public function tdownload($id){
		$model = new Tshare_Model;
		$res = $model->get_data($id);
        if(checkpermission(array("teacher"))){
            if(count(array_diff(explode(",", $res["view_permission"]),$_SESSION["class"])) == count(explode(",", $res["view_permission"]))){
                header("Location:tshare.php");
                exit();
            }
        }elseif(checkpermission(array("student"))){
            if(!in_array($_SESSION["class"],explode(",", $res["view_permission"]))){
                header("Location:tshare.php");
                exit();
            }
        }
		header('Content-Disposition: attachment; filename='.$res["filename"]);
		$passphrase = $res["password"];
		$iv = substr(md5("\x1B\x3C\x58".$passphrase, true), 0, 8);
		$key = substr(md5("\x2D\xFC\xD8".$passphrase, true) .
		md5("\x2D\xFC\xD9".$passphrase, true), 0, 24);
		$opts = array('iv'=>$iv, 'key'=>$key);
		$fp = fopen(dirname(dirname(dirname(__FILE__))).'/teacherupload/'.$res["realpath"].'.data', 'rb');
		stream_filter_append($fp, 'mdecrypt.rijndael-256', STREAM_FILTER_READ, $opts);
		fpassthru($fp);
		return false;
	}

    public function share_change_form($id,$alert = 0){
        $table = "";
        $model = new Tshare_Model;
        $option = "";
        $res = $model->get_data($id);
        if(checkpermission(array("teacher"))){
            if(count(array_diff(explode(",", $res["view_permission"]),$_SESSION["class"])) == count(explode(",", $res["view_permission"]))){
                header("Location:tshare.php");
                exit();
            }
        }elseif(checkpermission(array("student"))){
            if(!in_array($_SESSION["class"],explode(",", $res["view_permission"]))){
                header("Location:tshare.php");
                exit();
            }
        }
        $view_permission = explode(",", $res["view_permission"]);
        foreach($model->list_class() as $value) {
            $classname = $model->get_class($value["id"]);
            if(in_array($value["id"],$view_permission)) $h="selected"; else $h="";
            $option .= "<option value='".$value["id"]."' ".$h.">".$classname["grade"]."年".$classname["name"]."班</option>";
        }
        if($alert == 0) echo Template::call_view("tshare-modify",array("id"=>$id,"filename"=>$res["filename"],"option"=>$option,"alert"=>""));
        else echo Template::call_view("tshare-modify",array("id"=>$id,"filename"=>$res["filename"],"option"=>$option,"alert"=>'<div class="alert alert-success" style="margin-top:30px;">更新完成</div>'));
    }

    public function share_change_action($id,$view_permission,$filename,$delete){
        $model = new Tshare_Model;
        if(checkpermission(array("teacher"))){
            if(count(array_diff(explode(",", $res["view_permission"]),$_SESSION["class"])) == count(explode(",", $res["view_permission"]))){
                header("Location:tshare.php");
                exit();
            }
        }elseif(checkpermission(array("student"))){
            if(!in_array($_SESSION["class"],explode(",", $res["view_permission"]))){
                header("Location:tshare.php");
                exit();
            }
        }
        if($delete == 1){
            $res = $model->get_data($id);
            unlink(dirname(dirname(dirname(__FILE__)))."/teacherupload/".$res["realpath"].".data");
            $model->delete_data($id);
            header("location:tshare.php?mode=delete");
            return true;
        } 
        $view_permission_string = ",";
        foreach ($view_permission as $value) {
            $view_permission_string .= $value.",";
        }
        $model->update_data($view_permission_string,$filename,$id);
        $this->share_change_form($id,1);
        return false;
    }

    public function upload_form(){
        if(checkpermission(array("student"))){
            if(!in_array($_SESSION["class"],explode(",", $res["view_permission"]))){
                header("Location:tshare.php");
                exit();
            }
        }
        $table = "";
        $model = new Tshare_Model;
        $option = "";
        foreach($model->list_class() as $value) {
            $classname = $model->get_class($value["id"]);
            $option .= "<option value='".$value["id"]."'>".$classname["grade"]."年".$classname["name"]."班</option>";
        }
        echo Template::call_view("upload",array("data"=>$option));
    }

    public function upload_file($file_array,$view_permission,$id){
        if(checkpermission(array("student"))){
            if(!in_array($_SESSION["class"],explode(",", $res["view_permission"]))){
                header("Location:tshare.php");
                exit();
            }
        }
        $model=new Tshare_Model;
        if($view_permission != ""){
            $view_permission_string = ",";
            foreach ($view_permission as $value) {
                $view_permission_string .= $value.",";
            }
        }
        if($view_permission == "") $view_permission_string="";
        $i=count($file_array["file"]["name"]); 
        for ($j=0 ; $j<$i ; $j++){
            if($file_array['file']['error'][$j]>0){
                $result="unknow";
            }else{
                $result="success";
            }
            $passphrase = sha1(md5(mt_rand() . uniqid()));
            $filename = sha1(md5(mt_rand() . uniqid()));
            if ($result!="unknow") {
                $iv = substr(md5("\x1B\x3C\x58".$passphrase, true), 0, 8);
                $key = substr(md5("\x2D\xFC\xD8".$passphrase, true) .
                md5("\x2D\xFC\xD9".$passphrase, true), 0, 24);
                $opts = array('iv'=>$iv, 'key'=>$key);
                $fp = fopen($file_array['file']['tmp_name'][$j], 'rb');
                $dest = fopen(dirname(dirname(dirname(__FILE__))).'/teacherupload/' . $filename . '.data', 'wb');
                stream_filter_append($dest, 'mcrypt.rijndael-256', STREAM_FILTER_WRITE, $opts);
                stream_copy_to_stream($fp, $dest);
                fclose($fp);
                fclose($dest);
                $filedata = $model->insert_file($file_array['file']['name'][$j],$filename,$passphrase,$id,$view_permission_string);
                $download_path = "download.php?id=". $filedata['id'];
                $result="success";
            }
            if ($result=="success") {
                $size = $this->sizecount($file_array['file']['size'][$j]);
                $table .= '<tr class="success">
                <td>'. $file_array['file']['name'][$j] . '</td>
                <td>' . $size . '</td>
                <td><a href="'. $download_path .'" class="link">點這裡</a></td>
                <td>上傳成功</td>
                </tr>';
            }else{
            $table.='
                <tr class="error">
                <td>未知</td>
                <td>未知</td>
                <td>未知</a></td>
                <td>發生未知錯誤</td>
                </tr>';
            }
        }
        echo Template::call_view("uploadfile",array("data"=>$table));
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