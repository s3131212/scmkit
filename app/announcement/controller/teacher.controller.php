<?php
class Announcement_Controller {
	public function list_content($dataperpage,$nowpage){
		$table = "";
		if($nowpage != null && $nowpage != "1"){
			$offset = ($nowpage-1)*$dataperpage;
			$offset = $offset.", " . $dataperpage;
		}else $offset="0, " . $dataperpage;
        $model = new Announcement_Model;
        $data = $model->list_content($dataperpage,$nowpage,$offset);
        echo Announcement_View::list_content($data[0],$dataperpage,$nowpage,$data[1]);
	}

}