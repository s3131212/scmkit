<?php
class Curriculum_Model{
    public function list_curriculum($class){
        $res = $GLOBALS['db']->select('class',array('id'=>$class));
        return $res;
    }
    public function get_lpd($class){
        $lessons_per_day = $GLOBALS['db']->select('setting',array('name'=>"lessons_per_day"));
        return $lessons_per_day[0]["value"];
    }
}