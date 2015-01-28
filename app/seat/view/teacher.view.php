<?php
class Seat_View {
    public function ger_seat($data,$class){
        foreach ($class as $value) {
            $output .= "<div class='box'><h2>".$value["grade"]."年".$value["name"]."班</h2> <a href='modify/?id=".$value["id"]."' style='float:right;'><button>修改座位表</button></a>";
            $output .= Seat_View::list_table($data[$value["id"]]);
            $output .= "</div>";
        }
        echo Template::call_view(array("appname"=>"seat","file"=>"Seat"),array("data"=>$output));
    }
    public function list_table($data){
        $table = '<div class="desk"><p>講台</p></div><table class="table seat_table">';
        for($i = 1;$i<=$data["height"]; $i++){
            $table .= "<tr>";
            for($j = 1;$j<=$data["width"]; $j++){
                $table .= "<td class='num' style='width:".(100/$data["width"])."%;'>".$data["student"][$i][$j]["number"]."</td>";
            }
            $table .= "</tr><tr>";
            for($k = 1;$k<=$data["width"]; $k++){
                $table .= "<td class='name' style='width:".(100/$data["width"])."%;'>".$data["student"][$i][$k]["name"]."</td>";
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
    public function list_modify_table($width,$height,$data,$student,$class){
        $table = '直行（長度）<input type="text" name="height" value="'.$height.'" placeholder="直行" id="height" /> 橫列（寬度）<input type="text" name="width" value="'.$width.'" placeholder="橫列" id="width" /><br />更改長寬值請先送出再修改座位表';
        $table .= '<div class="desk"><p>講台</p></div><div class="modify_seat_table"><table class="table seat_table">';
        for($i = 1;$i<=$height; $i++){
            $table .= "<tr>";
            for($j = 1;$j<=$width; $j++){
                $table .= "<td class='num'><input type='text' class='num_input' data-name='name_".$i."_".$j."' name='num_".$i."_".$j."' id='num_".$i."_".$j."' value='".$student[$i][$j]["number"]."'></td>";
            }
            $table .= "</tr><tr>";
            for($k = 1;$k<=$width; $k++){
                $table .= "<td class='name'><span id='name_".$i."_".$k."'>".$student[$i][$k]["name"]."</span></td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table></div>";
        echo Template::call_view(array("appname"=>"seat","file"=>"Modify_seat"),array("data"=>$table,"class"=>$class));
    }
    public function modify_seat($data,$class){
        if(!in_array($class,$_SESSION['class'])){
            header("location:seat.php");
            exit();
        }
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
        header("location:seat.php?s=1");
    }
}