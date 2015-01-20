<?php
class Score_Controller {
    public function score_page($id,$class){
        echo View::call_view("Score",array("score"=>$this->student_list_score($id,$class),"scoresheet"=>$this->list_scoresheet($class)));
    }
	public function student_list_score($id,$class){
        $table = "";
        $model = new Score_Model;
        foreach ($model->get_table($id,$class) as $d) {
            $table .= "<tr><td>". $d["name"]."</td>
            <td>". $d["score"] ."</td>
            <td>". $d["average"] ."</td></tr>";
        }
        return $table;
	}
    public function list_scoresheet($class){
        $model = new Score_Model;
        $table = "";
        foreach ($model->select_scoresheet_by_class($class) as $d) {
            $table .= "<tr><td>".$d["name"]."</td><td><a href='scoresheet_view.php?id=".$d["id"]."'><button>檢視成績單</button></a></tr>";
        }
        return $table;
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
            $test_temp = $model->select_test($value);
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
                    $score = $model->select_score($testvalue,$studentvalue["id"]);
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
}