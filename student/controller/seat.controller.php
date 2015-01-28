<?php
class Seat_Controller{
    public function list_table($class){
        $model = new Seat_Model;
        $res = $model->get_data_seat($class);
        $width = $res["width"];
        $height = $res["height"];
        $data = json_decode($res["data"],true);
        $table = '<div class="desk"><p>講台</p></div><table class="table seat_table">';
        for($i = 1;$i<=$height; $i++){
            $table .= "<tr>";
            for($j = 1;$j<=$width; $j++){
                $student = $model->get_student($data[0][$i][$j]);
                $table .= "<td class='num' style='width:".(100/$width)."%;'>".$student["number"]."</td>";
            }
            $table .= "</tr><tr>";
            for($k = 1;$k<=$width; $k++){
                $student = $model->get_student($data[0][$i][$k]);
                $table .= "<td class='name' style='width:".(100/$width)."%;'>".$student["name"]."</td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table>";
        echo View::call_view("Seat",array("data"=>$table));
    }
}