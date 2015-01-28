<?php
//require_once (dirname(dirname(dirname(__FILE__))).'/excelreader/reader.php');
class Score_Controller {
    public function score_page(){
        echo Score_View::score_page($this->list_test(),$this->list_scoresheet());
    }
    public function list_test(){
        $model = new Score_Model;
        $table = array();
        foreach ($model->select_test() as $d) {
            $view_permission = explode(",", $d["class"]);
            if(count($view_permission) >= 3){
                array_shift($view_permission); array_pop($view_permission);
            }
            if(count(array_diff($view_permission,$_SESSION["class"])) != count($view_permission)){
                $table[] = $d;
            }
        }
        return $table;
    }
    public function list_scoresheet(){
        $model = new Score_Model;
        $table = array();
        foreach ($model->select_scoresheet_by_owner($_SESSION['login_id']) as $d) {
            $table[] = $d;
        }
        return $table;
    }
    public function view_score($id){
        echo Score_View::view_score($id);
    }
    public function update_score_table($test,$id){
        echo Score_View::update_score_table($test,$id);
    }
    public function scoresheet_form($id){
        if(isset($_POST["name"])){
            $this->scoresheet_modify($_POST["name"],$_POST["class"],$_POST["test"],$_GET["id"]);
            exit();
        }
        echo Score_View::scoresheet_form($id);
    }
    public function scoresheet_modify($name,$class,$test,$id){
        $model = new Score_Model;
        $class_string = ",";
        foreach ($class as $k) {
            $class_string .= $k.",";
        }

        $test_string = ",";
        foreach ($test as $k) {
            $test_string .= $k.",";
        }
        $id = $model->scoresheet_modify($name,$class_string,$test_string,$id);
    }
    public function update_score($test,$id,$score){
        $model = new Score_Model;
        $res = $model->select_test($test);
        $student = $model->select_student($id);
        if(!in_array($student['class'],$_SESSION["class"])){
            $alert = '<div class="alert alert-danger" style="display:none;">變更失敗</div>';
        }else{
            $table = $model->select_test_all_score($test);
            $table[$student["class"]][$id] = $score;
            $score_array = array();
            foreach ($table as $key) {
                foreach ($key as $value) {
                        $score_array[] = $value;
                }
            }
            $average = $this->average($score_array);
            $sd = $this->standard_deviation($average,$score_array);
            $model->update_score($test,$id,$score,$average,$sd);
            $alert = '<div class="alert alert-success" style="display:none;">變更完成</div>';
        }
        echo $alert;
    }
    public function scoresheet_view($id){
        echo Score_View::scoresheet_view($id);
    }
    public function standard_deviation($avg, $list){
        $total_var = 0;
        foreach ($list as $lv){
            $total_var += pow( ($lv - $avg), 2 );
        }
        return round(sqrt( $total_var / (count($list) - 1)),2);
    }
    public function average($list){
        $total = 0;
        $i = 0;
        foreach ($list as $key) {
            $total += $key;
            $i++;
        }
        return $total/$i;
    }
    public function school_ranking($score_array){
        $all_score = array(); //校排
        foreach($score_array as $key => $value){
            $all_score = $all_score + $value;
        }
        arsort($all_score,SORT_NUMERIC);
        $h = count($all_score);
        $i = 1;//名次
        $rank_array = array();
        foreach ($all_score as $key => $value) {
            $rank_array = $rank_array + array($key => $i);
            $i++;
        }
        return $rank_array;
    }
    public function create_chart($testid,$domid,$class){
        $model = new Score_Model;
        $table = $model->select_test_all_score($testid);
        $zero = $ten = $twenty = $thirty = $forty = $fifty = $sixty = $seventy = $eighty = $ninety = $hundred = 0;
        if($class != 0){
            foreach($table[$class] as $k => $value){
                switch(true) {
                    case $value >= 0 && $value < 10:
                        $zero ++;
                        break;
                    case $value >= 10 && $value < 20:
                        $ten ++;
                        break;
                    case $value >= 20 && $value < 30:
                        $twenty ++;
                        break;
                    case $value >= 30 && $value < 40:
                        $thirty ++;
                        break;
                    case $value >= 40 && $value < 50:
                        $forty ++;
                        break;
                    case $value >= 50 && $value < 60:
                        $fifty ++;
                        break;
                    case $value >= 60 && $value < 70:
                        $sixty ++;
                        break;
                    case $value >= 70 && $value < 80:
                        $seventy ++;
                        break;
                    case $value >= 80 && $value < 90:
                        $eighty ++;
                        break;
                    case $value >= 90 && $value < 100:
                        $ninety ++;
                        break;
                    case $value == 100:
                        $hundred ++;
                        break;
                    default:
                        break;
                }
            }
        }else{
            foreach ($table as $class) {
                foreach($class as $k => $value){
                    switch(true) {
                        case $value >= 0 && $value < 10:
                            $zero ++;
                            break;
                        case $value >= 10 && $value < 20:
                            $ten ++;
                            break;
                        case $value >= 20 && $value < 30:
                            $twenty ++;
                            break;
                        case $value >= 30 && $value < 40:
                            $thirty ++;
                            break;
                        case $value >= 40 && $value < 50:
                            $forty ++;
                            break;
                        case $value >= 50 && $value < 60:
                            $fifty ++;
                            break;
                        case $value >= 60 && $value < 70:
                            $sixty ++;
                            break;
                        case $value >= 70 && $value < 80:
                            $seventy ++;
                            break;
                        case $value >= 80 && $value < 90:
                            $eighty ++;
                            break;
                        case $value >= 90 && $value < 100:
                            $ninety ++;
                            break;
                        case $value == 100:
                            $hundred ++;
                            break;
                        default:
                            break;
                    }
                }
            }
            
        }
        return '
        var lineChartData'.$domid.' = {
            labels : ["0","10","20","30","40","50","60","70","80","90","100"],
            datasets : [{
                fillColor : "rgba(220,220,220,0.5)",
                strokeColor : "rgba(220,220,220,1)",
                pointColor : "rgba(220,220,220,1)",
                pointStrokeColor : "#fff",
                data : ['.$zero.','.$ten.','.$twenty.','.$thirty.','.$forty.','.$fifty.','.$sixty.','.$seventy.','.$eighty.','.$ninety.','.$hundred.']
            }]
        }
        var myLine'.$domid.' = new Chart(document.getElementById("score_canvas_'.$domid.'").getContext("2d")).Line(lineChartData'.$domid.');';
    }
}