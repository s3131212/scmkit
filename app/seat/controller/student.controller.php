<?php
class Seat_Controller{
    public function list_table(){
        $model = new Seat_Model;
        $class= $_SESSION["class"];
        $res = $model->get_data_seat($class);
        $width = $res["width"];
        $height = $res["height"];
        $data = json_decode($res["data"],true);
        $table = '<div class="desk"><p>講台</p></div><table class="table seat_table">';
        $student = array();
        for($i = 1;$i<=$height; $i++){
            for($j = 1;$j<=$width; $j++){
                $student[$data[0][$i][$j]] = $model->get_student($data[0][$i][$j]);
            }
        }
        echo Seat_View::list_table($data[0],$width,$height,$student);
    }
}