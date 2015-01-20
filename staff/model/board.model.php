<?php
class Board_Model {
    public function list_board($class){
        return $GLOBALS["db"]->select("board",array("floors"=>"0","class"=>$class),'last_update DESC');
    }
    public function get_board_data($id){
        return $GLOBALS["db"]->select("board",array("id"=>$id));
    }
    public function get_reply_data($id){
        return $GLOBALS["db"]->select("board",array("relation"=>$id),'floors ASC');
    }
    public function get_author_data($id){
        $res = $this->get_reply_data($id);
        return $GLOBALS["db"]->select($res[0]["author_per"],array("id"=>$res[0]["author"]));
    }
    public function get_class_data($id){
        $res = $GLOBALS["db"]->select("class",array("id"=>$id));
        return $res[0]["grade"]."年".$res[0]["name"]."班";
    }
    public function list_class(){
        $output = "";
        foreach ($GLOBALS["db"]->select("class") as $value) {
            $output .= "<a href='board.php?class=".$value["id"]."'><button>".$this->get_class_data($value["id"])."</button></a>";
        }
        return $output;
    }
    public function insert_board($title,$content,$class,$id=""){
        if($_GET["id"]!=null){
            $re = $id;
            $floor = $GLOBALS["db"]->ExecuteSQL(sprintf("SELECT Max(floors) as floor FROM `board` WHERE `relation` = '%s'",htmlspecialchars($id)));
            $floor = $floor[0]["floor"];
            $floor++;
        }else{
            $re = 0;
            $floor = 0;
        }
        $time=time(); //避免 SQL Insert 延遲
        if($GLOBALS["db"]->insert(array("title"=>View::xss_filter($title),"content"=>View::xss_filter($content,1),"floors"=>$floor,"last_update"=>$time,"author"=>$_SESSION["login_id"],"author_per"=>$_SESSION["permission"],"relation"=>$re,"class"=>$class),"board")) $error=1;
        else $error=2;
        if($id!=null){
            if($GLOBALS["db"]->update("question_ask",array("last_update"=>time()),array("id"=>$id))) $error=1;
            else $error=2;
        }
    }
}