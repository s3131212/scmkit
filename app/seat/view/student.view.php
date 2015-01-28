<?php
class Seat_View{
    public function list_table($data,$width,$height,$student){
        $table = '<div class="desk"><p>講台</p></div><table class="table seat_table">';
        for($i = 1;$i<=$height; $i++){
            $table .= "<tr>";
            for($j = 1;$j<=$width; $j++){
                $table .= "<td class='num' style='width:".(100/$width)."%;'>".$student[$data[$i][$j]]["number"]."</td>";
            }
            $table .= "</tr><tr>";
            for($k = 1;$k<=$width; $k++){
                $table .= "<td class='name' style='width:".(100/$width)."%;'>".$student[$data[$i][$k]]["name"]."</td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table>";
        echo Template::call_view(array("appname"=>"seat","file"=>"Seat"),array("data"=>$table));
    }
}