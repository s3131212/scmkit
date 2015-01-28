<?php
class Announcement_Model {
    public function list_content($dataperpage,$nowpage,$offset){
        $data = array();
        foreach($GLOBALS['db']->select("announcement","",'id DESC',$offset) as $d){ 
            $res = $GLOBALS['db']->select("staff", array("id" => $d["author"]));
            $data[] = array("title"=>$d["title"],"content"=>$d["content"],"date"=>$d["date"],"name"=>$res[0]["name"]);
        }
        $pagecheck = $GLOBALS['db']->ExecuteSQL("SELECT count(*) AS `count`  FROM `announcement`");
        return array($data,$pagecheck[0]["count"]); //array(資料 , 資料量)
    }
}