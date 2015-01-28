 <?php
class Curriculum_Controller{
    public function list_curriculum(){
        $model = new Curriculum_Model;
        $res = $model->list_curriculum($_SESSION["class"]);
        $lessons_per_day = $model->get_lpd($_SESSION["class"]);
        $data = json_decode($res[0]["curriculum"],true);
        echo Curriculum_View::list_curriculum($data,$lessons_per_day);
    }
}