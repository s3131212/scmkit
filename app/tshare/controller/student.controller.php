<?php
class Tshare_Controller {
	public function tshare_list_table(){
		$data = array();
		$model=new Tshare_Model;
		foreach($model->get_list() as $d){
            $data[] = array("id"=>$d['id'],"filename"=>$d['filename'],"uploader"=>$model->get_uploader($d["upload_teacher"],$d["is_staff"]),"upload_time"=>$d['upload_time']);
		}
		echo Tshare_View::tshare_list_table($data);
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
		$fp = fopen(dirname(dirname(dirname(dirname(__FILE__)))).'/teacherupload/'.$res["realpath"].'.data', 'rb');
		stream_filter_append($fp, 'mdecrypt.rijndael-256', STREAM_FILTER_READ, $opts);
		fpassthru($fp);
		return false;
	}
}