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
    public function get_class($id=0){
        if($id!=0){
            $res = $GLOBALS['db']->select('class',array('id'=>$id));
            return $res[0];
        }else{
            $res = $GLOBALS['db']->select('class');
            return $res;
        }
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
    public function list_modify_table(){
        $res = $GLOBALS['db']->select('seat',array('class'=>$this->class));
        if($res[0]["width"] == null && $res[0]["height"] == null){
            $w = $GLOBALS['db']->select('setting',array('name'=>"seat_default_width"));
            $h= $GLOBALS['db']->select('setting',array('name'=>"seat_default_height"));
            $height = $h[0]["value"];
            $width = $w[0]["value"];
        }else{
            $width = $res[0]["width"];
            $height = $res[0]["height"];
        }
        $data = json_decode($res[0]["data"],true);
        $table = '直行（長度）<input type="text" name="height" value="'.$height.'" placeholder="直行" id="height" /> 橫列（寬度）<input type="text" name="width" value="'.$width.'" placeholder="橫列" id="width" /><br />更改長寬厚請先送出再修改座位表';
        $table .= '<div class="desk"><p>講台</p></div><div class="modify_seat_table"><table class="table seat_table">';
        for($i = 1;$i<=$height; $i++){
            $table .= "<tr>";
            for($j = 1;$j<=$width; $j++){
                $student = $GLOBALS['db']->select('student',array('id'=>$data[0][$i][$j],"class"=>$this->class));
                $table .= "<td class='num'><input type='text' class='num_input' data-name='name_".$i."_".$j."' name='num_".$i."_".$j."' id='num_".$i."_".$j."' value='".$student[0]["number"]."'></td>";
            }
            $table .= "</tr><tr>";
            for($k = 1;$k<=$width; $k++){
                $student = $GLOBALS['db']->select('student',array('id'=>$data[0][$i][$k],"class"=>$this->class));
                $table .= "<td class='name'><span id='name_".$i."_".$k."'>".$student[0]["name"]."</span></td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table></div>";
        return $table;
    }
    public function modify_seat($array,$width,$height,$class,$method){
        if($method == "insert") $GLOBALS['db']->insert(array("class"=>Security::xss_filter($class),"data"=>json_encode(array($array)),"width"=>Security::xss_filter($width),"height"=>Security::xss_filter($height)),"seat"); 
        else $GLOBALS['db']->update("seat",array("data"=>json_encode(array($array)),"width"=>Security::xss_filter($width),"height"=>Security::xss_filter($height)),array("class"=>Security::xss_filter($class))); 
    }
}