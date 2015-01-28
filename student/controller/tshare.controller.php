<?php
class Tshare_Controller {
	public function tshare_list_table($class){
		$table = "";
		$model=new Tshare_Model;
		foreach($model->get_list() as $d){
            $view_permission=explode(",", $d['view_permission']);
            if(in_array($class, $view_permission)){ 
                $table .= "<tr><td>". $d['filename'] ."</td>
                <td>". $model->get_uploader($d["upload_teacher"],$d["is_staff"]) ."</td>
                <td>". $d['upload_time'] ."</td>
                <td><a href=\"download.php?id=". $d['id'] ."\" class=\"\"><button >下載</button></a></td>
                </tr>";
			} 
		}
		echo View::call_view("Tshare",array("data"=>$table));
	}

	public function tdownload($id){
		$model=new Tshare_Model;
		$res = $model->get_list($id);
		$res=$res[0];
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
}