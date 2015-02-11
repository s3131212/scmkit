<?php
class Curriculum_Controller{
    public function curriculum_ger(){
        $model = new Curriculum_Model;
        $output = "";
        if(checkpermission(array("student"))){
            $res = $model->list_curriculum($_SESSION["class"]); //借用一下輸出課表要用的method，反正要選取的資料一樣，這是抓取班級名稱用的
            $output .= '<div class="box"><h2>'.$res[0]["grade"].'年'.$res[0]["name"].'班</h2>'.$this->list_curriculum($_SESSION["class"]).'</div>';
        }elseif(checkpermission(array("teacher"))){
            foreach ($_SESSION["class"] as $val) {
                $res = $model->list_curriculum($val);
                $output .= '<div class="box"><h2>'.$res[0]["grade"].'年'.$res[0]["name"].'班</h2><a href="curriculum-modify.php?id='.$val.'"><button>修改課表</button></a>'.$this->list_curriculum($val).'</div>';
            }
        }elseif(checkpermission(array("staff"))){
            foreach ($model->list_class() as $val) {
                $res = $model->list_curriculum($val["id"]);
                $output .= '<div class="box"><h2>'.$res[0]["grade"].'年'.$res[0]["name"].'班</h2><a href="curriculum-modify.php?id='.$val['id'].'"><button>修改課表</button></a>'.$this->list_curriculum($val["id"]).'</div>';
            }
        }
        echo Template::call_view("curriculum",array("data"=>$output));
    }
    public function list_curriculum($class){
        $model = new Curriculum_Model;
        $res = $model->list_curriculum($class);
        $lessons_per_day = $model->get_lpd();
        $data = json_decode($res[0]["curriculum"],true);
        $table = '<table class="table curriculum_table"><thead><td>星期一</td><td>星期二</td><td>星期三</td><td>星期四</td><td>星期五</td><td>星期六</td></thead>';
        for($i = 1;$i<=$lessons_per_day; $i++){ //節數
            $table .= "<tr>";
            for($j = 1;$j<=6; $j++){ //星期
                $table .= "<td>".$data[0][$j][$i]."</td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table>";
        return $table;
    }
    public function modify_table($class){
        $model = new Curriculum_Model;
        $res = $model->list_curriculum($class); //這裡一樣是借用列課表的method
        $lessons_per_day = $model->get_lpd();
        $data = json_decode($res[0]["curriculum"],true);
        $table = '<table class="table curriculum_table"><thead><td>星期一</td><td>星期二</td><td>星期三</td><td>星期四</td><td>星期五</td><td>星期六</td></thead>';
        for($i = 1;$i<=$lessons_per_day; $i++){ //節數
            $table .= "<tr>";
            for($j = 1;$j<=6; $j++){ //星期
                $table .= "<td><input type='text' name='cur_".$i."_".$j."' id='cur_".$i."_".$j."' value='".$data[0][$j][$i]."' /></td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table>";
        echo Template::call_view("curriculum-modify",array("data"=>$table,"id"=>$class));
    }
    public function update_curriculum($class,$post){
        $model = new Curriculum_Model;
        $lessons_per_day = $model->get_lpd();
        $array = array();
        for($i = 1;$i<=$lessons_per_day; $i++){ //節數
            for($j = 1;$j<=6; $j++){ //星期
                $array[$j][$i] = $post["cur_".$i."_".$j];
            }
        }
        $model->update_curriculum($class,$array);
        header("Location: curriculum-modify.php?id=".$class."&s=1");
    }
}  