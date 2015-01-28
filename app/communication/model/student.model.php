<?php
class Communication_Model {
	public function get_content($date){
		$res = $GLOBALS['db']->select('communication',array('class'=>$_SESSION['class'],"date"=>$date));
		return $res[0]["content"];
	}
}