<?php
class Board_Controller {
    public function list_board($class){
        $model = new Board_Model;
        echo Board_View::list_board($model->list_board($class),$class);
    }
    public function view_board($id){
        $model = new Board_Model;
        $output = "";
        $res = $model->get_board_data($id);
        $au = $model->get_author_data($id);
        $main = array("title"=>$res[0]["title"],"content"=>$res[0]["content"],"create_time"=>$res[0]["create_time"],"author"=>$au[0]["name"]);
        $reply = array();
        $replydata = $model->get_reply_data($id);
        if(is_array($replydata)){
            foreach ($replydata as $value) {
                $au = $model->get_author_data($value["author"]);
                $reply[] = array("title"=>$value["title"],"content"=>$value["content"],"create_time"=>$value["create_time"],"author"=>$au[0]["name"]);
            }
        }
        echo Board_View::view_board($main,$reply,$id,$res[0]["class"]);
    }
    public function new_board(){
        if(isset($_POST["content"])){
            $this->new_board_post($_POST["title"],$_POST["content"],$_SESSION["class"],$_GET["id"]);
            exit();
        }
        echo Board_View::new_board();
    }

    public function new_board_post($title,$content,$class,$id=""){
        $model = new Board_Model;
        $model->insert_board($title,$content,$class,$id);
        if($id!=null){
            header("Location: ../view/?id=".$id."&s=1");
            exit();
        }else{
            header("Location: ../list/?class=".$class);
            exit();
        }
    }
}