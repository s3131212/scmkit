<?php
class Seat_Controller {
    public function ger_seat(){
        $data = array();
        $class = array();
        $model = new Seat_Model;
        foreach ($_SESSION["class"] as $value) {
            $class[] = $model->get_class($value);
            $data[$value] = $this->get_information_for_listing_table($value);
        }
        echo Seat_View::ger_seat($data,$class);
    }
    public function get_information_for_listing_table($class){
        $model = new Seat_Model;
        $res = $model->get_data($class);
        $student = array(array());
        $data = json_decode($res["data"],true);
        for($i = 1;$i<=$res["height"]; $i++){
            $table .= "<tr>";
            for($j = 1;$j<=$res["width"]; $j++){
                $student[$i][$j] = $model->get_student($data[0][$i][$j]);
            }
        }
        return array("width"=>$res["width"],"height"=>$res["height"],"student"=>$student);
    }
    
    public function get_name_json($id,$class){
        $model = new Seat_Model;
        $model->get_name_json($id,$class);
    }
    public function list_modify_table($class){
        if(!in_array($class,$_SESSION['class'])){
            Header("location:/");
            exit();
        }
        if(isset($_POST["width"])&&isset($_POST["height"])){
            $this->modify_seat($_POST,$class);
        }
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
        $student = array(array());
        for($i = 1;$i<=$height; $i++){
            for($j = 1;$j<=$width; $j++){
                $student[$i][$j] = $model->get_student($data[0][$i][$j]);
            }
        }
        echo Seat_View::list_modify_table($width,$height,$data[0],$student,$class);
    }
    public function modify_seat($data,$class){
        if(!in_array($class,$_SESSION['class'])){
            header("location:/");
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
        header("location:../view?s=1");
    }
}