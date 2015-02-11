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
    public function get_class_array(){
        $res = $GLOBALS['db']->select('class');
        return $res;
    }
	public function update_communication($empty,$class,$content,$date){
		$content = str_replace(chr(13).chr(10), "<br />",$content);
		if($empty=="true"){
        	$result = $GLOBALS['db']->insert(array("class"=>Security::xss_filter($class),"date"=>Security::xss_filter($date),"content"=>Security::xss_filter($content,true)),"communication");
    	}else{
        	$result = $GLOBALS['db']->update("communication",array("content"=>Security::xss_filter($content,true)),array("class"=>Security::xss_filter($class),"date"=>Security::xss_filter($date)));
    	}
    	return $result;
	}
}