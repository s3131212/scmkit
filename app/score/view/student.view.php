<?php
class Score_View {
    public function score_page($score,$scoresheet){
        echo Template::call_view(file_get_contents(dirname(dirname(__FILE__)).'/template/student/Score.php'),array("score" => Score_View::student_list_score($score),"scoresheet" => Score_View::list_scoresheet($scoresheet)));
    }
    public function student_list_score($data){
        $table = "";
        foreach ($data as $d) {
            $table .= "<tr><td>". $d["name"]."</td>
            <td>". $d["score"] ."</td>
            <td>". $d["average"] ."</td></tr>";
        }
        return $table;
    }
    public function list_scoresheet($data){
        $table = "";
        foreach ($data as $d) {
            $table .= "<tr><td>".$d["name"]."</td><td><a href='scoresheet/?id=".$d["id"]."'><button>檢視成績單</button></a></tr>";
        }
        return $table;
    }
    public function scoresheet_view($id,$name,$data){
        $output = "";
        foreach ($data as $key => $value) {
            $output .= "<tr>";
            foreach ($data[$key] as $k => $v) {
                $output .= "<td>".$v."</td>";
            }
            $output .= "</tr>";
        }
        echo Template::call_view(file_get_contents(dirname(dirname(__FILE__)).'/template/student/Scoresheet_view.php'),array("id"=>$id,"name"=>$name,"data"=>$output,"id"=>$id));
    }
}