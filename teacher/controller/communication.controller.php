<?php
class Communication_Controller {
	public function get_content($class,$date = 0){
        $communication_data = "";
		$model = new Communication_Model;
        if($date == 0) $date = date("Y/m/d");
        foreach ($class as $d) {
            $res = $model->get_content($date,$d);
            if($res == null){
                $communication_data .= "<div class='box'><h2>".$model->get_class($d)."</h2><div class='communication'>本日尚未新增聯絡簿</div><br /><a href='communication_change.php?class=".$d."&date=".$date."&empty=true' class='btn btn-link'>新增".$model->get_class($d)."在".$date."的聯絡簿</a></div>";
            }else{
                $communication_data .= "<div class='box'><h2>".$model->get_class($d)."</h2><div class='communication'>".$res."</div><br /><a href='communication_change.php?class=".$d."&date=".$date."&empty=false' class='btn btn-link'>修改".$model->get_class($d)."在".$date."的聯絡簿</a></div>";
            }
            //$i++;
        }
		echo View::call_view("Communication",array("data"=>$communication_data,"date"=>$date));
	}
    public function get_content_json($class,$date = 0){
        $communication_data = "";
        $model = new Communication_Model;
        if($date == 0) $date = date("Y/m/d");
        foreach ($class as $d) {
            $res = $model->get_content($date,$d);
            if($res == null){
                $communication_data .= "<div class='box'><h2>".$model->get_class($d)."</h2><div class='communication'>本日尚未新增聯絡簿</div><br /><a href='communication_change.php?class=".$d."&date=".$date."' class='btn btn-link'>新增".$model->get_class($d)."在".$date."的聯絡簿</a></div>";
            }else{
                $communication_data .= "<div class='box'><h2>".$model->get_class($d)."</h2><div class='communication'>".$res."</div><br /><a href='communication_change.php?class=".$d."&date=".$date."' class='btn btn-link'>修改".$model->get_class($d)."在".$date."的聯絡簿</a></div>";
            }
        }
        $json = array(array("content" => $communication_data));
        echo json_encode($json);
    }
    public function update_communication($empty,$class,$content,$date){
        $model = new Communication_Model;
        if(!isset($class) || !isset($class)){
            echo json_encode(array(array("status"=>false)));
            exit();
        }elseif(!in_array($class,$_SESSION['class'])){
            echo json_encode(array(array("status"=>false)));
            exit();
        }else{
            echo json_encode(array(array("status"=>$model->update_communication($empty,$class,$content,$date))));
        }
    }
    public function get_editor_data($empty,$class,$date){
        $model = new Communication_Model;
        $res = $model->get_content($date,$class);
        $content = str_replace("<br />",chr(13).chr(10),$res);
        echo View::call_view("Communication_change",array("content"=>$content,"date"=>$date,"class_id"=>$class,"empty"=>$empty,"class"=>$model->get_class($class)));
    }

}