<?php
class Curriculum_View{
    public function list_curriculum($data,$lessons_per_day){
        $table = '<table class="table curriculum_table"><thead><td>星期一</td><td>星期二</td><td>星期三</td><td>星期四</td><td>星期五</td><td>星期六</td></thead>';
        for($i = 1;$i<=$lessons_per_day; $i++){ //節數
            $table .= "<tr>";
            for($j = 1;$j<=6; $j++){ //星期
                $table .= "<td>".$data[0][$j][$i]."</td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table>";
        echo Template::call_view(array("appname"=>"curriculum","file"=>"Curriculum"),array("data"=>$table));
    }
}