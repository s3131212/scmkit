<?php
class Score_Model {
    public function get_table($id,$class){
        $array = array();
        foreach ($GLOBALS['db']->Select("test", array("class"=>"%,".$class.",%"), '', '', true) as $d) {
                $res = $GLOBALS['db']->Select("scoredata", array("studentid"=>$id,"testid"=>$d["id"]));
                $array[] = array("name"=>$d["name"],"score"=>$res[0]["score"],"average"=>$d["average"]);
        }
        return $array;
    }
    public function select_scoresheet_by_class($class){
        $array = array();
        foreach ($GLOBALS['db']->Select("scoresheet",array("classid"=>"%,".$class.",%"), '', '', true) as $d) {
            $array[] = array("name"=>$d["name"],"id"=>$d["id"]);
        }
        return $array;
    }
    public function select_class_student($id){
        $res = $GLOBALS['db']->select("student", array("class" => $id));
        return $res;
    }
    public function select_test($id){
        $res = $GLOBALS['db']->select("test", array("id" => $id));
        return $res[0];
    }
    public function select_student($id){
        $res = $GLOBALS['db']->select("student", array("id" => $id));
        return $res[0];
    }
    public function select_scoresheet($id = false){
        $res = $GLOBALS['db']->select("scoresheet", array("id" => $id));
        return $res[0];
    }
    public function select_score($testid,$studentid){
        $res = $GLOBALS['db']->select("scoredata", array("testid" => $testid, "studentid"=>$studentid));
        return $res[0]["score"];
    }
}