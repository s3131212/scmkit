<?php
class Communication_Model {
	public function get_content($date,$class){
		$res = $GLOBALS['db']->select('communication',array('class'=>$class,"date"=>$date));
		return $res[0]["content"];
	}
	public function get_class($id){
		$res = $GLOBALS['db']->select('class',array('id'=>$id));
		return $res[0]["grade"]."年".$res[0]["name"]."班";
	}
	public function update_communication($empty,$class,$content,$date){
		if($empty=="true"){
        	$result = $GLOBALS['db']->insert(array("class"=>View::xss_filter($class),"date"=>View::xss_filter($date),"content"=>nl2br(View::xss_filter($content,true))),"communication");
    	}else{
        	$result = $GLOBALS['db']->update("communication",array("content"=>nl2br(View::xss_filter($content,true))),array("class"=>$class,"date"=>$date));
    	}
    	return $result;
	}
}