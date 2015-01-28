<?php
class Curriculum_Controller{
    public function curriculum_ger(){
        $model = new Curriculum_Model;
        $output = array();
        foreach ($_SESSION["class"] as $val) {
            $res = $model->list_curriculum($val); //借用一下輸出課表要用的method，反正要選取的資料一樣，這是抓取班級名稱用的
            $output[$val] = array("class"=>$res[0],"data"=>$this->list_curriculum($val));
        }
        echo Curriculum_View::curriculum_ger($output);
    }
    public function list_curriculum($class){
        $model = new Curriculum_Model;
        $res = $model->list_curriculum($class);
        $lessons_per_day = $model->get_lpd();
        $data = json_decode($res[0]["curriculum"],true);
        $output = array(array());
        for($i = 1;$i<=$lessons_per_day; $i++){ //節數
            for($j = 1;$j<=6; $j++){ //星期
               $output[$i][$j] = $data[0][$j][$i];
            }
        }
        return array("curriculum"=>$output,"lpd"=>$lessons_per_day);
    }
    public function modify_table($class){
        if(!in_array($class,$_SESSION["class"])){
            header("location:/");
            return false;
        }
        if(isset($_POST["cur_1_1"])){
            $this->update_curriculum($class);
            exit();
        }
        echo Curriculum_View::modify_table($this->list_curriculum($class),$class);
    }
    public function update_curriculum($class){
        $model = new Curriculum_Model;
        $lessons_per_day = $model->get_lpd();
        $array = array();
        for($i = 1;$i<=$lessons_per_day; $i++){ //節數
            for($j = 1;$j<=6; $j++){ //星期
                $array[$j][$i] = $_POST["cur_".$i."_".$j];
            }
        }
        $model->update_curriculum($class,$array);
        header('Location:../view/?s=1');
    }
}  