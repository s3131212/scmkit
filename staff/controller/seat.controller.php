<?php
class Seat_Controller {
    public function ger_seat(){
        $output = "";
        $model = new Seat_Model;
        foreach ($model->get_class() as $value) {
            $res = $model->get_class($value["id"]);
            $output .= "<div class='box'><h2>".$res["grade"]."年".$res["name"]."班</h2> <a href='modify_seat.php?id=".$value["id"]."' style='float:right;'><button>修改座位表</button></a>";
            $output .= $this->list_table($value["id"]);
            $output .= "</div>";
        }
        echo View::call_view("Seat",array("data"=>$output));
    }
    public function list_table($class){
        $model = new Seat_Model;
        $res = $model->get_data($class);
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
        return $table;
    }
    public function get_name_json($id,$class){
        $model = new Seat_Model;
        $model->get_name_json($id,$class);
    }
    public function list_modify_table($class){
        $model = new Seat_Model;
        $res = $model->get_data($class);
        if($res["width"] == null && $res["height"] == null){
            $default = $model->get_seat_default();
            $height = $default["h"];
            $width = $default["w"];
        }else{
            $width = $res["width"];
            $height = $res["height"];
        }
        $data = json_decode($res["data"],true);
        $table = '直行（長度）<input type="text" name="height" value="'.$height.'" placeholder="直行" id="height" /> 橫列（寬度）<input type="text" name="width" value="'.$width.'" placeholder="橫列" id="width" /><br />更改長寬厚請先送出再修改座位表';
        $table .= '<div class="desk"><p>講台</p></div><div class="modify_seat_table"><table class="table seat_table">';
        for($i = 1;$i<=$height; $i++){
            $table .= "<tr>";
            for($j = 1;$j<=$width; $j++){
                $student = $model->get_student($data[0][$i][$j]);
                $table .= "<td class='num'><input type='text' class='num_input' data-name='name_".$i."_".$j."' name='num_".$i."_".$j."' id='num_".$i."_".$j."' value='".$student["number"]."'></td>";
            }
            $table .= "</tr><tr>";
            for($k = 1;$k<=$width; $k++){
                $student = $model->get_student($data[0][$i][$k]);
                $table .= "<td class='name'><span id='name_".$i."_".$k."'>".$student["name"]."</span></td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table></div>";
        echo View::call_view("Modify_seat",array("data"=>$table,"class"=>$class));
    }
    public function modify_seat($data,$class){
        $model = new Seat_Model;
        $res = $model->get_data($class);
        if($res["width"] == null && $res["height"] == null){
            $method = "insert";
        }else{
            $method = "update";
        }
        $height = $data["height"];
        $width = $data["width"];
        $array = array();
        for($i = 1;$i<=$height; $i++){
            for($j = 1;$j<=$width; $j++){
                $student = $model->get_student_num($data["num_".$i."_".$j],$class);
                $array[$i][$j] = $student["id"];
            }
        }
        $model->modify_seat($array,$data["width"],$data["height"],$class,$method);
        header("Location: modify_seat.php?id=".$id."&s=1");
        return true;
    }
}