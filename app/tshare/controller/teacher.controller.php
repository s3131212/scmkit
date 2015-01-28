<?php
class Tshare_Controller {
	public function tshare_list_table(){
		echo Tshare_View::tshare_list_table();
	}

	public function tdownload($id){
		$model=new Tshare_Model;
        if($_SESSION["login_id"] != $model->get_uploader($id) && !$model->is_staff($id)){
            header("location:/");
            exit();
        }
		$res = $model->get_data($id);
		header('Content-Disposition: attachment; filename='.$res["filename"]);
		$passphrase = $res["password"];
		$iv = substr(md5("\x1B\x3C\x58".$passphrase, true), 0, 8);
		$key = substr(md5("\x2D\xFC\xD8".$passphrase, true) .
		md5("\x2D\xFC\xD9".$passphrase, true), 0, 24);
		$opts = array('iv'=>$iv, 'key'=>$key);
		$fp = fopen(dirname(dirname(dirname(dirname(__FILE__)))).'/teacherupload/'.$res["realpath"].'.data', 'rb');
		stream_filter_append($fp, 'mdecrypt.rijndael-256', STREAM_FILTER_READ, $opts);
		fpassthru($fp);
		return false;
	}

    public function share_change_form($id,$alert = 0){
        if((isset($_POST["filename"]) || isset($_GET["method"])) && $alert == 0){
            if( isset($_GET["method"]) && $_GET["method"] == "delete" && isset($_GET["id"])){
                $this->share_change_action($_GET["id"],$_POST["view_permission"],$_POST["filename"],1,$_SESSION["class"]);
                exit();
            }else{
                $this->share_change_action($_GET["id"],$_POST["view_permission"],$_POST["filename"],0,$_SESSION["class"]);
                exit();
            }
        }
        echo Tshare_View::share_change_form($id,$alert);
    }

    public function share_change_action($id,$view_permission,$filename,$delete){
        $model = new Tshare_Model;
        if($delete == 1){
            $res = $model->get_data($id);
            unlink(dirname(dirname(dirname(dirname(__FILE__))))."/teacherupload/".$res["realpath"].".data");
            $model->delete_data($id);
            header("location:list?mode=delete");
            return true;
        } 
        if($view_permission != ""){
            $view_permission_string=",";
            foreach($view_permission as $d){
                $view_permission_string .= $d.",";
            }
        }
        if($view_permission == "") $view_permission_string="";

        $model->update_data($view_permission_string,$filename,$id);
        $this->share_change_form($id,1);
        return false;
    }

    public function upload_form(){
        if(isset($_FILES["file"])){
            $this->upload_file($_FILES,$_POST["view_permission"],$_SESSION["login_id"]);
            exit();
        }
        echo Tshare_View::upload_form();
    }

    public function upload_file($file_array,$view_permission,$id){
        $model = new Tshare_Model;
        $output = array();
        if($view_permission != ""){
            $view_permission_string=",";
            foreach($view_permission as $d){
                $view_permission_string .= $d.",";
            }
        }
        if($view_permission == "") $view_permission_string="";
        $i = count($file_array["file"]["name"]); 
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
                $dest = fopen(dirname(dirname(dirname(dirname(__FILE__)))).'/teacherupload/' . $filename . '.data', 'wb');
                stream_filter_append($dest, 'mcrypt.rijndael-256', STREAM_FILTER_WRITE, $opts);
                stream_copy_to_stream($fp, $dest);
                fclose($fp);
                fclose($dest);
                $filedata = $model->insert_file($file_array['file']['name'][$j],$filename,$passphrase,$id,$view_permission_string);
                $download_path = "download?id=". $filedata['id'];
                $result="success";
            }
            if ($result=="success") {
                $output[] = array("name"=>$file_array['file']['name'][$j],"size"=>$this->sizecount($file_array['file']['size'][$j]),"download_path"=>$download_path);
            }else{
                $output[] = false;
            }
        }
        echo Tshare_View::upload_file($output);
    }
    public function class2string($array){
        array_pop($array); array_shift($array);
        $h=count($array);
        $i=0;
        while($i<$h){
            $classname=$GLOBALS['db']->select("class", array("id" => $array[$i]));
            if($i==0){
                $classstring=$classname[0]["grade"]."年".$classname[0]["name"]."班";
            }else{
                $classstring.=$classname[0]["grade"]."年".$classname[0]["name"]."班";
            }
            if(($h-1)!=$i) $classstring.="與";
            $i++;
        }
        return $classstring;
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