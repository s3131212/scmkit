<?php
class Communication_Controller {
	public function get_content($date = 0){
        $communication_data = "";
		$model = new Communication_Model;
        if($date == 0) $date = date("Y/m/d");
        foreach ($model->get_class_array() as $d) {
            $res = $model->get_content($date,$d["id"]);
            if($res == null){
                $communication_data .= "<div class='box'><h2>".$model->get_class($d["id"])."</h2><div class='communication'>本日尚未新增聯絡簿</div><br /><a href='communication_change.php?class=".$d["id"]."&date=".$date."&empty=true' class='btn btn-link'>新增".$model->get_class($d["id"])."在".$date."的聯絡簿</a></div>";
            }else{
                $communication_data .= "<div class='box'><h2>".$model->get_class($d["id"])."</h2><div class='communication'>".$res."</div><br /><a href='communication_change.php?class=".$d["id"]."&date=".$date."&empty=false' class='btn btn-link'>修改".$model->get_class($d["id"])."在".$date."的聯絡簿</a></div>";
            }
            //$i++;
        }
		echo View::call_view("Communication",array("data"=>$communication_data,"date"=>$date));
	}
    public function get_content_json($date = 0){
        $communication_data = "";
        $model = new Communication_Model;
        if($date == 0) $date = date("Y/m/d");
        foreach ($model->get_class_array() as $d) {
            $res = $model->get_content($date,$d["id"]);
            if($res == null){
                $communication_data .= "<div class='box'><h2>".$model->get_class($d["id"])."</h2><div class='communication'>本日尚未新增聯絡簿</div><br /><a href='communication_change.php?class=".$d["id"]."&date=".$date."' class='btn btn-link'>新增".$model->get_class($d["id"])."在".$date."的聯絡簿</a></div>";
            }else{
                $communication_data .= "<div class='box'><h2>".$model->get_class($d["id"])."</h2><div class='communication'>".$res."</div><br /><a href='communication_change.php?class=".$d["id"]."&date=".$date."' class='btn btn-link'>修改".$model->get_class($d["id"])."在".$date."的聯絡簿</a></div>";
            }
        }
        $json = array(array("content" => $communication_data));
        echo json_encode($json);
    }
    public function update_communication($empty,$class,$content,$date){
        $model = new Communication_Model;
        if(!isset($class) || !isset($class)){
            $json=array(array("status"=>'<div class="alert alert-danger" style="display:none;">發生預期之外的錯誤</div>'));
            echo json_encode($json);
            exit();
        }else{
            $json = array(array("status"=>$model->update_communication($empty,$class,$content,$date)));
            echo json_encode($json);
        }
    }
    public function get_editor_data($empty,$class,$date){
        $model = new Communication_Model;
        $res = $model->get_content($date,$class);
        $content = str_replace("<br />",chr(13).chr(10),$res);
        echo View::call_view("Communication_change",array("content"=>$content,"date"=>$date,"class_id"=>$class,"empty"=>$empty,"class"=>$model->get_class($class)));
    }

}