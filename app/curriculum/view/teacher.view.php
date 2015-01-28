<?php
class Curriculum_View{
    public function curriculum_ger($data){
        $model = new Curriculum_Model;
        //var_dump($data);
        $output = "";
        foreach ($_SESSION["class"] as $val) {
            $output .= '<div class="box"><h2>'.$data[$val]["class"]["grade"].'年'.$data[$val]["class"]["name"].'班</h2><a href="../modify/?id='.$val.'"><button>修改課表</button></a>'.Curriculum_View::list_curriculum($data[$val]["data"]).'</div>';
        }
        echo Template::call_view(array("appname"=>"curriculum","file"=>"Curriculum"),array("data"=>$output));
    }
    public function list_curriculum($data){
        $table = '<table class="table curriculum_table"><thead><td>星期一</td><td>星期二</td><td>星期三</td><td>星期四</td><td>星期五</td><td>星期六</td></thead>';
        for($i = 1;$i<=$data["lpd"]; $i++){ //節數
            $table .= "<tr>";
            for($j = 1;$j<=6; $j++){ //星期
                $table .= "<td>".$data["curriculum"][$i][$j]."</td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table>";
        return $table;
    }
    public function modify_table($data,$class){
        $table = '<table class="table curriculum_table"><thead><td>星期一</td><td>星期二</td><td>星期三</td><td>星期四</td><td>星期五</td><td>星期六</td></thead>';
        for($i = 1;$i<=$data["lpd"]; $i++){ //節數
            $table .= "<tr>";
            for($j = 1;$j<=6; $j++){ //星期
                $table .= "<td><input type='text' name='cur_".$i."_".$j."' id='cur_".$i."_".$j."' value='".$data["curriculum"][$i][$j]."' /></td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table>";
        echo Template::call_view(array("appname"=>"curriculum","file"=>"Modify_curriculum"),array("data"=>$table,"id"=>$class));
    }
}  