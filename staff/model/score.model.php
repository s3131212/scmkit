<?php
class Score_Model {

    public function select_test(){
        return $GLOBALS['db']->Select("test");
    }
    public function select_test_by_id($id){
        $res = $GLOBALS['db']->select("test", array("id" => $id));
        return $res[0];
    }
    public function select_class($id){
        $res = $GLOBALS['db']->select("class", array("id" => $id));
        return $res[0]["grade"] . "年" . $res[0]["name"] . "班";
    }
    public function select_student($id){
        $res = $GLOBALS['db']->select("student", array("id" => $id));
        return $res[0];
    }
    public function select_student_name($id){
        $res = $GLOBALS['db']->select("student", array("name" => $id));
        return $res[0];
    }
    public function select_class_student($id){
        $res = $GLOBALS['db']->select("student", array("class" => $id));
        return $res;
    }
    public function select_student_score($test,$id){
        $res = $GLOBALS['db']->select("scoredata", array("studentid" => $id,"testid"=>$test));
        return $res[0]["score"];
    }
    public function select_test_all_score($id){
        $data = array();
        foreach ($GLOBALS['db']->ExecuteSQL("SELECT a.*, b.* FROM `student` as a, `scoredata` as b where a.id = b.studentid") as $k) {
            $data[$k["class"]][$k["studentid"]] = $k["score"];
        }
        return $data;
    }
    public function update_score($testid,$studentid,$score,$average,$sd){
        $GLOBALS['db']->update('scoredata',array("score"=>$score),array("testid"=>$testid,"studentid"=>$studentid));
        $GLOBALS['db']->update('test',array("standard_deviation"=>$sd,"average"=>$average),array("id"=>$testid));
    }
    public function test_modify($name,$view_permission,$id){
        $GLOBALS['db']->update('test',array("name"=>View::xss_filter($name),"class"=>$view_permission),array("id"=>$id));
    }
    public function delete_test($id){
        $GLOBALS['db']->delete('test', array('id' => $id));
        $GLOBALS['db']->delete('scoredata', array('testid' => $id));
    }
    public function select_scoresheet_all(){
        $res = $GLOBALS['db']->select("scoresheet");
        return $res;
    }
    public function select_scoresheet($id = false){
        $res = $GLOBALS['db']->select("scoresheet", array("id" => $id));
        return $res[0];
    }
    public function scoresheet_modify($name,$class,$test,$id){
        if($id == "new"){
            $GLOBALS['db']->insert(array("name"=>$name,"classid"=>$class,"testid"=>$test,"owner"=>$_SESSION["login_id"]),'scoresheet');
            $res = $GLOBALS['db']->select("scoresheet", array("name"=>$name,"classid"=>$class,"testid"=>$test,"owner"=>$_SESSION["login_id"]));
            $id = $res[0]["id"];
        }else{
            $GLOBALS['db']->update('scoresheet',array("name"=>$name,"classid"=>$class,"testid"=>$test),array("id"=>$id));
        }
        header("Location: scoresheet_view.php?id=".$id);
    }
    public function test_option($test_string = ""){
        $options = "";
        if($test_string == ""){
            foreach($GLOBALS['db']->select("test") as $value) {
                $options .= "<option value='".$value["id"]."'>".$value["name"]."</option>";
            }
        }else{
            $test_array = explode(",", $test_string);
            foreach($GLOBALS['db']->select("test") as $value) {
                if(in_array($value["id"], $test_array)){
                    $options .= "<option value='".$value["id"]."' selected>".$value["name"]."</option>";
                }else{
                    $options .= "<option value='".$value["id"]."'>".$value["name"]."</option>";
                }
            }
        }
        return $options;
    }
    public function class_option($class_string = ""){
        $options = "";
        if($class_string == ""){
            foreach($GLOBALS['db']->select("class") as $value) {
                $options .= "<option value='".$value["id"]."'>".$value["grade"]."年".$value["name"]."班</option>";
            }
        }else{
            $class_array = explode(",", $class_string);
            foreach($GLOBALS['db']->select("class") as $value) {
                if(in_array($value["id"], $class_array)){
                    $options .= "<option value='".$value["id"]."' selected>".$value["grade"]."年".$value["name"]."班</option>";
                }else{
                    $options .= "<option value='".$value["id"]."'>".$value["grade"]."年".$value["name"]."班</option>";
                }
            }
        }
        return $options;
    }
    public function insert_score($test_name,$view_permission_string,$score,$average,$sd){
        $GLOBALS['db']->insert(array("name"=>View::xss_filter($test_name),"class"=>$view_permission_string,"average"=>$average,"standard_deviation"=>$sd),"test"); 
        $data = $GLOBALS['db']->select("test",array("name"=>$test_name,"class"=>$view_permission_string,"average"=>$average,"standard_deviation"=>$sd));
        foreach ($score as $class) {
            foreach ($class as $student => $score) {
                $GLOBALS['db']->insert(array("studentid"=>$student,"testid"=>$data[0]["id"],"score"=>$score),"scoredata");
            }
        }
        return $data[0]["id"];
    }
}