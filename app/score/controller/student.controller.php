<?php
class Score_Controller {
    public function score_page($id,$class){
        $model = new Score_Model;
        echo Score_View::score_page($model->get_table($id,$class),$model->select_scoresheet_by_class($class));
    }
    public function scoresheet_view($id){
        $model = new Score_Model;
        $res = $model->select_scoresheet($id);
        $output = array();
        $temp = array();
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
        $output[0] = array();
        $output[0][0] = "";
        foreach ($test as $value) {
            $test_temp = $model->select_test($value);
            $output[0][] .= $test_temp["name"];
            $test_total[$test_counter] = 0;
            $test_counter ++ ;
        }
        $output[0][] = "總分";
        $output[0][] = "平均";
        $output[0][] = "排名";
        foreach ($class as $classvalue) {
            foreach ($model->select_class_student($classvalue) as $studentvalue) {
                $student_data = $model->select_student($studentvalue["id"]);
                $temp[] = $student_data["name"];
                $i = 0;
                $score_counter = 0;
                foreach ($test as $testvalue) {
                    $score = $model->select_score($testvalue,$studentvalue["id"]);
                    if($score == "") $score = 0;
                    $temp[] = $score;
                    $score_counter += $score;
                    $test_total[$i] += $score;
                    $i++;
                }
                $temp[] = $score_counter;
                $temp[] = round($score_counter/$i , 2);
                $temp[] = "<span data-score=".$score_counter." class='sort'></span>";
                $output[] = $temp;
                $total_score += $score_counter;
                $total_student++;
                $temp = array(); //清空暫存
            }
        }
        $temp[] = "平均";
        for($i = 0;$i<count($test);$i++){
            $temp[] = round(($test_total[$i]/$total_student),2);
        }
        $temp[] = $total_score;
        $temp[] = round(($total_score/($total_student*$test_counter)),2);
        $temp[] = "";
        $output[] = $temp;
        echo Score_View::scoresheet_view($id,$res["name"],$output);
    }
}