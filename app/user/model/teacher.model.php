<?php
class User_Model {
    public function get_data($id){
        $res = $GLOBALS['db']->select("teacher", array("id" => $_SESSION["login_id"]));
        $classname = $GLOBALS['db']->select("class", array("id" => $_SESSION["class"]));
        return array("name"=>$res[0]["name"],"login_name"=>$res[0]["login_name"],"address"=>$res[0]["address"],"phone"=>$res[0]["phone"],"personalid"=>$res[0]["personalid"],"email"=>$res[0]["email"],"class"=>$this->class_string(),"id"=>$id);
    }
    public function set_pass($psd,$id){
        $GLOBALS['db']->update('teacher',array("password"=>md5($psd)),array("id" => $id));
    }
    private function class_string(){
        $h=count($_SESSION["class"]);
        $i=0;
        while($i<$h){
            $classname = $GLOBALS['db']->select("class", array("id" => $_SESSION["class"][$i]));
            if($i==0){
                $classstring = $classname[0]["grade"]."年".$classname[0]["name"]."班";
            }else{
                $classstring .= $classname[0]["grade"]."年".$classname[0]["name"]."班";
            }
            if(($h-1)!=$i) $classstring.="與";
            $i++;
        }
        return $classstring;
    }
}