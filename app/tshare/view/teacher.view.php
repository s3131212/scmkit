<?php
class Tshare_View {
	public function tshare_list_table(){
		$table = "";
		$model = new Tshare_Model;
        foreach($model->get_list(0,$_SESSION["login_id"]) as $d){
            $view_permission = explode(",", $d["view_permission"]);
            $view_permission_string = Tshare_Controller::class2string($view_permission);
            $table .= "<tr>
                <td>" . $d['filename'] ."</td>
                <td>" . $d['upload_time'] . "</td>
                <td>" . $view_permission_string . "</td>
                <td><div class=\"btn-group\"><a href=\"download?id=". $d['id'] ."\" class=\"btn link\"><button>下載</button></a>";
            if($d["upload_teacher"] == $_SESSION["login_id"]){
                $table .= "<a href=\"change?id=" . $d['id'] . " \" class=\"btn btn-default\"><button>變更</button></a></div></td>";
            }
            $table .= "</tr>";
        }
        foreach($model->get_list(1) as $d){
            $view_permission = explode(",", $d["view_permission"]);
            $view_permission_string = Tshare_Controller::class2string($view_permission);
            $table .= "<tr>
                <td>" . $d['filename'] ."</td>
                <td>" . $d['upload_time'] . "</td>
                <td>" . $view_permission_string . "</td>
                <td><div class=\"btn-group\"><a href=\"download?id=". $d['id'] ."\" class=\"btn link\"><button>下載</button></a>
                </tr>";
        }
		echo Template::call_view(array("appname"=>"tshare","file"=>"Tshare"),array("data"=>$table));
	}

	public function tdownload($id,$user){
		$model=new Tshare_Model;
        if($user != $model->get_uploader($id) && !$model->is_staff($id)){
            header("location:../");
            exit();
        }
		$res = $model->get_data($id);
		header('Content-Disposition: attachment; filename='.$res["filename"]);
		$passphrase = $res["password"];
		$iv = substr(md5("\x1B\x3C\x58".$passphrase, true), 0, 8);
		$key = substr(md5("\x2D\xFC\xD8".$passphrase, true) .
		md5("\x2D\xFC\xD9".$passphrase, true), 0, 24);
		$opts = array('iv'=>$iv, 'key'=>$key);
		$fp = fopen('../teacherupload/'.$res["realpath"].'.data', 'rb');
		stream_filter_append($fp, 'mdecrypt.rijndael-256', STREAM_FILTER_READ, $opts);
		fpassthru($fp);
		return false;
	}

    public function share_change_form($id,$alert=0){
        $table = "";
        $model = new Tshare_Model;
        $option = "";
        $res = $model->get_data($id);
        $view_permission = explode(",", $res["view_permission"]);
        foreach($_SESSION["class"] as $value) {
            $classname = $model->get_class($value);
            if(in_array($value,$view_permission)) $h="selected"; else $h="";
            $option .= "<option value='".$value."' ".$h.">".$classname["grade"]."年".$classname["name"]."班</option>";
        }
        if(!$alert) echo Template::call_view(array("appname"=>"tshare","file"=>"Share_change"),array("id"=>$id,"filename"=>$res["filename"],"option"=>$option,"alert"=>""));
        else echo Template::call_view(array("appname"=>"tshare","file"=>"Share_change"),array("id"=>$id,"filename"=>$res["filename"],"option"=>$option,"alert"=>'<div class="alert alert-success" style="margin-top:30px;">更新完成</div>'));
    }

    public function share_change_action($id,$view_permission,$filename,$delete,$class_array){
        $model = new Tshare_Model;
        if($delete == 1){
            $res = $model->get_data($id);
            unlink("../teacherupload/".$res["realpath"].".data");
            $model->delete_data($id);
            header("location:teacher_share.php?mode=delete");
            return true;
        } 
        $h = count($view_permission);
        $i = 0;
        while($i < $h){
            if($i == 0){
                $view_permission_string = $view_permission[$i];
            }else{
                $view_permission_string .= $view_permission[$i];
            }
            if(($h-1) != $i){$view_permission_string .= ",";}
            $i++;
        }
        $model->update_data($view_permission_string,$filename,$id);
        $this->share_change_form($id,$class_array,1);
        return false;
    }

    public function upload_form(){
        $table = "";
        $model = new Tshare_Model;
        $option = "";
        foreach($_SESSION["class"] as $value) {
            $classname = $model->get_class($value);
            $option .= "<option value='".$value."'>".$classname["grade"]."年".$classname["name"]."班</option>";
        }
        echo Template::call_view(array("appname"=>"tshare","file"=>"Upload"),array("data"=>$option));
    }

    public function upload_file($data){
        $table = "";
        foreach($data as $d){
            if ($d !== false) {
                $table .= '<tr class="success">
                <td>'. $d['name'] . '</td>
                <td>' . $d["size"] . '</td>
                <td><a href="'. $d["download_path"] .'" class="link">點這裡</a></td>
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
        echo Template::call_view(array("appname"=>"tshare","file"=>"Uploadfile"),array("data"=>$table));
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