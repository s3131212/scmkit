<?php
class Class_Model{
	public function list_class(){
		$res = $GLOBALS['db']->Select("class");
        return $res;
	}
	public function list_student_in_class($id){
		$res = $GLOBALS['db']->Select("student",array("class"=>$id));
        return $res;
	}
	public function update_name($grade,$name,$id){
		$result = $GLOBALS['db']->update('class',array("grade"=>View::xss_filter($grade),"name"=>View::xss_filter($name)),array("id"=>$id));
		return $result;
	}
	public function insert_class($grade,$name){
		$result = $GLOBALS['db']->insert(array("grade"=>View::xss_filter($grade),"name"=>View::xss_filter($name)),"class");
		return $result;
	}
	public function get_data($id){
		$res = $GLOBALS['db']->Select("class",array("id"=>$id));
        return $res[0];
	}
}