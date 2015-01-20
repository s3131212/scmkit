<?php
class Communication_View {
	public function list_content($data,$date){
		if($data == null) $output = "<div class='box'>本日尚未新增聯絡簿</div>";
		else $output = "<div class='box'>".$data."</div>";
		echo Template::call_view(array("appname"=>"communication","file"=>"Communication"),array("data"=>$output,"date"=>$date));
	}
}