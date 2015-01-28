<?php
class Seat_Model{
    public function get_data_seat($class){
        $res = $GLOBALS['db']->select('seat',array('class'=>$class));
        return $res[0];
    }
    public function get_student($id){
        $res = $GLOBALS['db']->select('student',array('id'=>$id));
        return $res[0];
    }
}