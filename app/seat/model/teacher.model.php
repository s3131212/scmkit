<?php
class Seat_Model {
    public function get_data($class){
        $res = $GLOBALS['db']->select('seat',array('class'=>$class));
        return $res[0];
    }
    public function get_student($id){
        $student = $GLOBALS['db']->select('student',array('id'=>$id));
        return $student[0];
    }
    public function get_student_num($id,$class){
        $student = $GLOBALS['db']->select('student',array('number'=>$id,"class"=>$class));
        return $student[0];
    }
    public function get_class($id){
        $res = $GLOBALS['db']->select('class',array('id'=>$id));
        return $res[0];
    }
    public function get_seat_default(){
        $w = $GLOBALS['db']->select('setting',array('name'=>"seat_default_width"));
        $h = $GLOBALS['db']->select('setting',array('name'=>"seat_default_height"));
        return array("w"=>$w[0]["value"],"h"=>$h[0]["value"]);
    }
    public function get_name_json($id,$class){
        $res=$GLOBALS['db']->select("student", array("number" => $id,"class"=>$class));
        $json=array(array("content"=>$res[0]["name"]));
        echo json_encode($json);
    }
    public function modify_seat($array,$width,$height,$class,$method){
        if($method == "insert") $GLOBALS['db']->insert(array("class"=>Template::xss_filter($this->class),"data"=>json_encode(array($array)),"width"=>Template::xss_filter($width),"height"=>Template::xss_filter($height)),"seat"); 
        else $GLOBALS['db']->update("seat",array("data"=>json_encode(array($array)),"width"=>Template::xss_filter($width),"height"=>Template::xss_filter($height)),array("class"=>$class)); 
    }
}