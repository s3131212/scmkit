<?php
class Homework_Model {
    public function homework_list(){
        $array = array();
        if(checkpermission(array("student"))){
            $array = $GLOBALS['db']->select("homework",array("class"=>"%".$_SESSION["class"]."%"),"","",true);
        }elseif(checkpermission(array("teacher"))){
            $res = $GLOBALS['db']->select("homework");
            foreach($res as $d){
                if(count(array_diff(explode(",", $d["class"]),$_SESSION["class"])) != count(explode(",", $d["class"]))){
                    $array[] = array("id"=>$d['id'],"name"=>$d['name'],"start_date"=>$d["start_date"],"end_date"=>$d['end_date'],"teacher"=>$d["teacher"]);
                }
            } 
        }elseif(checkpermission(array("staff"))){
            foreach($GLOBALS['db']->select("homework") as $d){
                $array[] = array("id"=>$d['id'],"name"=>$d['name'],"start_date"=>$d["start_date"],"end_date"=>$d['end_date'],"teacher"=>$d["teacher"]);
            } 
        }
        return $array;
    }

    public function get_data($id){
        $res = $GLOBALS['db']->select("homework",array("id"=>$id));
        return $res[0];
    }

    public function get_class($id){
        $res = $this->get_data($id);
        $stu = $GLOBALS['db']->select("student",array("id"=>$res["upload_student"]));
        return $stu[0]["class"];
    }
    public function get_class_id($id){
        $res = $GLOBALS['db']->select("class",array("id"=>$id));
        return $res[0];
    }
    public function get_class_list(){
        $res = $GLOBALS['db']->select("class");
        return $res;
    }
    public function homework_user_upload($h_id){
        $array = array();
        foreach($GLOBALS['db']->select("homework_upload",array("homework_id"=>$h_id)) as $d){
            $array[] = array("id"=>$d['id'],"filename"=>$d['filename'],"upload_time"=>$d["upload_time"],"upload_student"=>$d["upload_student"]);
        }
        return $array;
    }
    public function get_handed_student_num($id){
        $handed_num = $GLOBALS['db']->ExecuteSQL(sprintf("SELECT count(DISTINCT `upload_student`) AS `count`  FROM `homework_upload` WHERE `homework_id` = '%s'",$id));
        $res = $this->get_data($id);
        $class=explode(",", $res["class"]);
        $total_num = 0;
        foreach ($class as $v) {
            $k = $GLOBALS['db']->ExecuteSQL(sprintf("SELECT count(*) AS `count`  FROM `student` WHERE `class` = '%s'",$id));
            $total_num += $k[0]["count"];
        }
        return array($total_num,$handed_num[0]["count"]);
    }

    public function new_homework($name,$start_date,$end_date,$description,$class){
        $class_string = ",";
        foreach ($class as $value) {
            $class_string .= $value.",";
        }
        $GLOBALS['db']->insert(array("name"=>Security::xss_filter($name),"start_date"=>Security::xss_filter($start_date),"end_date"=>Security::xss_filter($end_date),"description"=>Security::xss_filter($description,true),"class"=>$class_string),"homework");
        $res = $GLOBALS['db']->select("homework",array("name"=>Security::xss_filter($name),"start_date"=>Security::xss_filter($start_date),"end_date"=>Security::xss_filter($end_date),"description"=>Security::xss_filter($description,true),"class"=>$class_string));
        return $res[0]["id"];
    }

    public function modify_homework($name,$start_date,$end_date,$description,$class,$id){
        $class_string = ",";
        foreach ($class as $value) {
            $class_string .= $value.",";
        }
        $GLOBALS['db']->update("homework",array("name"=>Security::xss_filter($name),"start_date"=>Security::xss_filter($start_date),"end_date"=>Security::xss_filter($end_date),"description"=>Security::xss_filter($description,true),"class"=>$class_string),array("id"=>$id));
    }

    public function get_file_data($id){
        $res = $GLOBALS['db']->select("homework_upload",array("id"=>$id));
        return $res[0];
    }

    public function get_teacher($id){
        $res = $GLOBALS['db']->select("teacher",array("id"=>$id));
        return $res[0];
    }

    public function get_student($id){
        $stu = $GLOBALS['db']->select("student",array("id"=>$id));
        return $stu[0];
    }

    public function class2string($string){
        $array = explode(",", $string);
        array_shift($array); array_pop($array);
        $h=count($array);
        $i=0;
        while($i<$h){
            $classname=$GLOBALS['db']->select("class", array("id" => $array[$i]));
            if($i==0){
                $classstring=$classname[0]["grade"]."年".$classname[0]["name"]."班";
            }else{
                $classstring.=$classname[0]["grade"]."年".$classname[0]["name"]."班";
            }
            if(($h-1)!=$i) $classstring.="與";
            $i++;
        }
        return $classstring;
    }

    private function sizecount($size){
        if ($size<1000) {
            return $size."B";
        }elseif ($size>=1000&&$size<1000000) {
            return round(($size/1000),2).'KB';
        }elseif ($size>=1000000&&$size<1000000000) {
            return round(($size/1000000),2).'MB';
        }elseif ($size>=1000000000&&$size<1000000000000) {
            return round(($size/1000000000),2).'GB';
        }
    }
}