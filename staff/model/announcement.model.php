<?php
class Announcement_Model {
    public function list_content($dataperpage,$nowpage,$offset){
        $data = array();
        foreach($GLOBALS['db']->select("announcement","",'id DESC',$offset) as $d){ 
            $res = $GLOBALS['db']->select("staff", array("id" => $d["author"]));
            $data[] = array("id"=>$d["id"],"title"=>$d["title"],"content"=>$d["content"],"date"=>$d["date"],"name"=>$res[0]["name"]);
        }
        $pagecheck = $GLOBALS['db']->ExecuteSQL("SELECT count(*) AS `count`  FROM `announcement`");
        return array($data,$pagecheck[0]["count"]); //array(資料 , 資料量)
    }
    public function delete_announcement($id){
        $GLOBALS['db']->delete('announcement', array('id' => $id));
    }
    public function modify_announcement($id = "",$content,$title,$new,$author){
        if($new){
            $result = $GLOBALS['db']->insert(array("date"=>date("Y/m/d"),"title"=>View::xss_filter($title),"content"=>View::xss_filter(nl2br($content),true),"author"=>$author),"announcement");
            $alert = '<div class="alert alert-success" style="display:none;">新增完成</div>';
        }else{
            $result = $GLOBALS['db']->update("announcement",array("date"=>date("Y/m/d"),"title"=>View::xss_filter($title),"content"=>View::xss_filter(nl2br($content),true),"author"=>$author),array("id"=>$id));
            $alert = '<div class="alert alert-success" style="display:none;">修改完成</div>';
        }
        return $result;
    }
    public function get_data($id){
        $res = $GLOBALS['db']->select("announcement",array("id"=>$id));
        return $res[0];
    }
}