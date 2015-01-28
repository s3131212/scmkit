<?php
class Announcement_Controller {
	public function list_content($dataperpage,$nowpage = 1){
		$table = "";
		if($nowpage != null && $nowpage != "1"){
			$offset = ($nowpage-1)*$dataperpage;
			$offset = $offset.", " . $dataperpage;
		}else $offset="0, " . $dataperpage;
        $model = new Announcement_Model;
        $data = $model->list_content($dataperpage,$nowpage,$offset);
		foreach($data[0] as $d){ 
			$table .= "<div class='box'><h3>". $d["title"] ."</h3>
			<blockquote>". $d["content"] ."
			<footer style=\"text-align:right;\"> - ". $d["date"] ." , ". $d["name"] ."</footer>
			</blockquote></div>";
		}
        echo Announcement_View::list_data($data[0],$dataperpage,$nowpage,$data[1]);
	}
}