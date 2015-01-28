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
    public function select_class_student($id){
        $res = $GLOBALS['db']->select("student", array("class" => $id));
        return $res;
    }
    public function select_student_score($test,$studentid){
        $res = $GLOBALS['db']->select("scoredata", array("studentid" => $studentid,"testid"=>$test));
        return $res[0]["score"];
    }
    public function select_scoresheet_by_owner($owner){
        $res = $GLOBALS['db']->select("scoresheet", array("owner" => $owner));
        return $res;
    }
    public function select_scoresheet($id = false){
        $res = $GLOBALS['db']->select("scoresheet", array("id" => $id));
        return $res[0];
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
            if(count($test_array) >= 3){
                array_shift($test_array); array_pop($test_array);
            }

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
            foreach($_SESSION["class"] as $value) {
                $res = $GLOBALS['db']->select("class",array("id"=>$value));
                $options .= "<option value='".$value."'>".$res[0]["grade"]."年".$res[0]["name"]."班</option>";
            }
        }else{
            $class_array = explode(",", $class_string);
            if(count($class_array) >= 3){
                array_shift($class_array); array_pop($class_array);
            }

            foreach($_SESSION["class"] as $value) {
                $res = $GLOBALS['db']->select("class",array("id"=>$value));
                if(in_array($value, $class_array)){
                    $options .= "<option value='".$value."' selected>".$res[0]["grade"]."年".$res[0]["name"]."班</option>";
                }else{
                    $options .= "<option value='".$value."'>".$res[0]["grade"]."年".$res[0]["name"]."班</option>";
                }
            }
        }
        return $options;
    }
}