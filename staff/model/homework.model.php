<?php
class Homework_Model {
    public function homework_list(){
        $array = array();
        foreach($GLOBALS['db']->select("homework") as $d){
            $array[] = array("id"=>$d['id'],"name"=>$d['name'],"start_date"=>$d["start_date"],"end_date"=>$d['end_date'],"teacher"=>$d["teacher"]);
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
        $h = count($class);
        $i = 0;
        while($i < $h){
            if($i == 0){
                $class_string = $class[$i];
            }else{
                $class_string .= $class[$i];
            }
            if(($h-1) != $i){$class_string .= ",";}
            $i++;
        }
        $GLOBALS['db']->insert(array("name"=>View::xss_filter($name),"start_date"=>View::xss_filter($start_date),"end_date"=>View::xss_filter($end_date),"description"=>View::xss_filter($description,true),"class"=>$class_string),"homework");
        $res = $GLOBALS['db']->select("homework",array("name"=>$name,"start_date"=>$start_date,"end_date"=>$end_date,"description"=>$description,"class"=>$class_string,"teacher"=>$_SESSION["login_id"]));
        return $res[0]["id"];
    }

    public function modify_homework($name,$start_date,$end_date,$description,$class,$id){
        $h = count($class);
        $i = 0;
        while($i < $h){
            if($i == 0){
                $class_string = $class[$i];
            }else{
                $class_string .= $class[$i];
            }
            if(($h-1) != $i){$class_string .= ",";}
            $i++;
        }
        $GLOBALS['db']->update("homework",array("name"=>View::xss_filter($name),"start_date"=>View::xss_filter($start_date),"end_date"=>View::xss_filter($end_date),"description"=>View::xss_filter($description,true),"class"=>$class_string),array("id"=>$id));
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