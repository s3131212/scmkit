<?php
class Board_Controller {
    public function list_board($class){
        echo Board_View::list_board($class);
    }
    public function list_class(){
        echo Board_View::list_class();
    }
    public function view_board($id){
        echo Board_View::view_board($id);
    }
    public function new_board(){
        if(isset($_POST["content"])){
            $this->new_board_post($_POST["title"],$_POST["content"],$_GET["class"],$_GET["id"]);
            exit();
        }
        echo Board_View::new_board();
    }

    public function new_board_post($title,$content,$class,$id=""){
        $model = new Board_Model;
        $model->insert_board($title,$content,$class,$id);
        if($id!=null){
            header("Location: view/?id=".$id."&s=1");
            exit();
        }else{
            header("Location: list/?class=".$class);
            exit();
        }
    }
}