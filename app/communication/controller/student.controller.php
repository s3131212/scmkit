<?php
class Communication_Controller {
	public function list_content($date = 0){
		$model = new Communication_Model;
		if($date == 0) $date = date("Y/m/d");
		$data = $model->get_content($date);
		echo Communication_View::list_content($data,$date);
	}
    public function get_content_json($date = 0){
        $model = new Communication_Model;
        if($date == 0) $date=date("Y/m/d");
        $data = $model->get_content($date);
        if($data==NULL) $output = "<div class='box'>本日尚未新增聯絡簿</div>";
        else $output = "<div class='box'>".$data."</div>";
        $json = array(array("content" => $output));
        echo json_encode($json);
    }
}