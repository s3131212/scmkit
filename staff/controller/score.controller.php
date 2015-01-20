<?php
require_once (dirname(dirname(dirname(__FILE__))).'/core/excelreader/reader.php');
class Score_Controller {
    public function score_page(){
        echo View::call_view("Score",array("score"=>$this->list_test(),"scoresheet"=>$this->list_scoresheet()));
    }
    public function list_test($class_array = ""){
        $table = "";
        $model = new Score_Model;
        foreach ($model->select_test() as $d) {
            $table .= "<tr><td>" . $d["name"] . "</td><td><a href='score_view.php?id=" . $d["id"] . "' class='btn'><button>檢視成績</button></a></td></tr>";
        }
        return $table;
    }
    public function list_scoresheet(){
        $model = new Score_Model;
        $table = "";
        foreach ($model->select_scoresheet_all() as $d) {
            $table .= "<tr><td>".$d["name"]."</td><td><a href='scoresheet_view.php?id=".$d["id"]."'><button>檢視成績單</button></a></tr>";
        }
        return $table;
    }
    public function view_score($id){
        $model = new Score_Model;
        $res = $model->select_test_by_id($id);
        $table = $model->select_test_all_score($id);
        $output = "";
        $js = "";
        $all_score = $this->school_ranking($table); //校排
        foreach($table as $key => $value){
            $all_score[] = $table[$key];//校排
            $class_score = $table[$key];//班排
            arsort($class_score,SORT_NUMERIC);//班排排序
            $class_rate = 1; //班排計數器
            $output .= "<div class='box'><div style='width:45%; display: inline-block;' class='score_left'><h3>" . $model->select_class($key) . "</h3>";
            $output .= '<table class="score_table"><thead><td>學生名稱</td><td>成績</td><td>班級排名</td><td>全校排名</td><td>編輯</td></thead>';
            foreach($class_score as $k => $v){
                $student = $model->select_student($k);
                $output .= "<tr><td>". $student["name"] . "</td><td>". $v ."</td><td>". $class_rate ."</td><td>". $all_score[$k] ."</td><td><a href='score_modify.php?id=".$k."&test=".$id."' class='btn'><button>編輯</button></a></td></tr>";
                $class_rate++;
            }
            $output .= "</table>";
            $output .= "<table class='score_table' style='margin-top:30px;'><tr><td>班平均</td><td>".$this->average($class_score)."</td></tr><tr><td>標準差</td><td>".$this->standard_deviation($this->average($class_score),$class_score)."</td></tr></table>";
            $output .= "</div><div style='width:45%; display: inline-block; float:right;' class='score_right'>";
            $domid =  sha1(md5(mt_rand() . uniqid()));
            $output .= '<canvas id="score_canvas_'.$domid.'" class="score_class_chart"></canvas></div></div>';
            $js .= $this->create_chart($id,$domid,$key);
        }
        $output .= "<div class='box'><h3>統計資料</h3>";
        $output .= '<table class="score_table"><thead><td>資料名稱</td><td>數據</td></thead>';
        $output .= "<tr><td>全校平均值</td><td>".$res["average"] ."</td></tr>";
        $output .= "<tr><td>全校標準差</td><td>".$res["standard_deviation"] ."</td></tr>";
        $output .= "</table>";
        $domid =  sha1(md5(mt_rand() . uniqid()));;
        $js .= $this->create_chart($id,$domid,0);
        $output .= '<h3>全校成績分布</h3><canvas id="score_canvas_'.$domid.'" height="500" width="700"></canvas></div>';
        echo View::call_view("Score_view",array("data"=>$output,"id"=>$id,"name"=>$res["name"],"js"=>$js));
    }
    public function import_score($file_tmp,$view_permission,$name){
        $model = new Score_Model;
        $data = new Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('UTF-8');
        $data->read($file_tmp);
        $score = array();
        $score_array = array();
        for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
            if($data->sheets[0]['cells'][$i][1]!=null&&$data->sheets[0]['cells'][$i][2]!=null){
                $student = $model->select_student_name($data->sheets[0]['cells'][$i][1]);
                $array = array($data->sheets[0]['cells'][$i][1]=>$data->sheets[0]['cells'][$i][2]);
                if(!is_array($score[$student["class"]])) (array)$score[$student["class"]]=$array;
                else (array)$score[$student["class"]] = $score[$student["class"]]+$array;
                $score_array[] = $data->sheets[0]['cells'][$i][2];
            }
        }
        $average = $this->average($score_array);
        $sd = $this->standard_deviation($average,$score_array);
        $view_permission_string = ",";
        foreach ($view_permission as $k) {
            $view_permission_string .= $k.",";
        }
        $id = $model->insert_score($test_name,$view_permission_string,$score,$average,$sd);
        return $id;
    }
    public function score_new_form($type){
        $model = new Score_Model;
        if($type == "new") echo View::call_view("Score_new",array("options"=>$model->class_option()));
        elseif($type == "import") echo View::call_view("Score_import",array("options"=>$model->class_option()));
    }
    public function test_modify_form($id){
        $model = new Score_Model;
        $res = $model->select_test_by_id($id);
        echo View::call_view("Test_modify",array("test_name"=>$res["name"],"option"=>$model->class_option($res["class"]),"id"=>$id));
    }
    public function test_modify($id,$name,$view_permission){
        $model = new Score_Model;
        $class_string = ",";
        foreach ($view_permission as $k) {
            $class_string .= $k.",";
        }
        $model->test_modify($name,$class_string,$id);
    }
    public function delete_test($id){
        $model = new Score_Model;
        $model->delete_test($id);
    }
    public function score_new($name,$score_post,$view_permission,$test_name){
        $score = array();
        $score_array = array();
        $model = new Score_Model;
        foreach ($name as $key => $value) {
            $student = $model->select_student_name($value);
            $array = array($student["id"]=>$score_post[$key]);
            if(!is_array($score[$student["class"]])) (array)$score[$student["class"]]=$array;
            else (array)$score[$student["class"]] = $score[$student["class"]]+$array;
            $score_array[] = $score_post[$key];
        }
        $average = $this->average($score_array);
        $sd = $this->standard_deviation($average,$score_array);
        $view_permission_string = ",";
        foreach ($view_permission as $k) {
            $view_permission_string .= $k.",";
        }
        $id = $model->insert_score($test_name,$view_permission_string,$score,$average,$sd);
        return $id;
    }
    public function scoresheet_form($id){
        $model = new Score_Model;
        if($id == "new"){
            echo View::call_view("Scoresheet_modify",array("class"=>$model->class_option(),"test"=>$model->test_option(),"id"=>$id));
        }else{
            $res = $model->select_scoresheet($id);
            echo View::call_view("Scoresheet_modify",array("name"=>$res["name"],"class"=>$model->class_option($res["classid"]),"test"=>$model->test_option($res["testid"]),"id"=>$id));
        }
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
    public function update_score_table($test,$id){
        $model = new Score_Model;
        $res = $model->select_test_by_id($test);
        $student = $model->select_student($id);
        echo View::call_view("Score_modify",array("id"=>$id,"test"=>$test,"student_name"=>$student["name"],"test_name"=>$res["name"],"student_score"=>$model->select_student_score($test,$id)));
    }
    public function update_score($test,$id,$score){
        $model = new Score_Model;
        $res = $model->select_test($test);
        $student = $model->select_student($id);
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
        return $alert;
    }
    public function scoresheet_view($id){
        $model = new Score_Model;
        $res = $model->select_scoresheet($id);
        $output = "";
        $test = explode(",", $res["testid"]);
        $class = explode(",", $res["classid"]);
        if(count($test) >= 3){
            array_shift($test); array_pop($test);
        }
        if(count($class) >= 3){
            array_shift($class); array_pop($class);
        }
        $test_counter = 0; //計算考試量
        $test_data = array(); //暫存考試資料減少資料庫查詢次數
        $test_total = array(); //每個考卷的總分
        $total_student = 0;
        $total_score = 0;
        $output .= "<tr><td></td>";
        foreach ($test as $value) {
            $test_temp = $model->select_test_by_id($value);
            $output .= "<td>".$test_temp["name"]."</td>";
            $test_total[$test_counter] = 0;
            $test_counter ++ ;
        }
        $output .= "<td>總分</td><td>平均</td><td>排名</td></tr>";
        foreach ($class as $classvalue) {
            foreach ($model->select_class_student($classvalue) as $studentvalue) {
                $student_data = $model->select_student($studentvalue["id"]);
                $output .= "<tr><td>".$student_data["name"]."</td>";
                $i = 0;
                $score_counter = 0;
                foreach ($test as $testvalue) {
                    $score = $model->select_student_score($testvalue,$studentvalue["id"]);
                    if($score == "") $score = 0;
                    $output .= "<td>".$score."</td>";
                    $score_counter += $score;
                    $test_total[$i] += $score;
                    $i++;
                }
                $output .= "<td>".$score_counter."</td><td>".round($score_counter/$i , 2)."</td><td data-score=".$score_counter." class='sort'></td></tr>";
                $total_score += $score_counter;
                $total_student++;
            }
        }
        $output .= "<tr><td>平均</td>";
        for($i = 0;$i<count($test);$i++){
            $output .= "<td>".($test_total[$i]/$total_student)."</td>";
        }
        $output .= "<td>".$total_score."</td><td>".($total_score/($total_student*$test_counter))."</td><td></td></tr>";
        echo View::call_view("Scoresheet_view",array("id"=>$id,"name"=>$res["name"],"data"=>$output,"id"=>$id));
    }
    private function standard_deviation($avg, $list){
        $total_var = 0;
        foreach ($list as $lv){
            $total_var += pow( ($lv - $avg), 2 );
        }
        return round(sqrt( $total_var / (count($list) - 1)),2);
    }
    private function average($list){
        $total = 0;
        $i = 0;
        foreach ($list as $key) {
            $total += $key;
            $i++;
        }
        return $total/$i;
    }
    private function school_ranking($score_array){
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
    private function create_chart($testid,$domid,$class){
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