<?php
class Board_Controller {
    public function list_board($class){
        $model = new Board_Model;
        $output = "";
        foreach ($model->list_board($class) as $value) {
            $output .= "<div class='box'><h2><a href='view_board.php?id=".$value["id"]."'>".$value["title"]."</a></h2><p>".$value["content"]."</p></div>";
        }
        echo View::call_view("Board",array("data"=>$output,"class"=>$class));
    }
    public function view_board($id){
        $model = new Board_Model;
        $output = "";
        $res = $model->get_board_data($id);
        $au = $model->get_author_data($id);
        $output .= "<h2>".$res[0]["title"]."</h2><p>".$res[0]["content"]."</p>";
        $output .= "<p class='q_footer'>由".$au[0]["name"]."發表於".$res[0]["create_time"]."</p>";

        $replyoutput = "";
        $reply = $model->get_reply_data($id);
        if(is_array($reply)){
            $replyoutput .= '<div class="box">';
            foreach ($reply as $value) {
                $au = $model->get_author_data($id);
                $replyoutput .= "<h3>".$value["title"]."</h3><p>".$value["content"]."</p>";
                $replyoutput .= "<p class='q_footer'>由".$au[0]["name"]."發表於".$value["create_time"]."</p>";
            }
            $replyoutput .= '</div>';
        }
        echo View::call_view("View_board",array("data"=>$output,"reply"=>$replyoutput,"class"=>$res[0]["class"],"arg"=>"id=".$id."&class=".$res[0]["class"]));
    }
    public function new_board($title,$content,$class,$id=""){
        $model = new Board_Model;
        $model->insert_board($title,$content,$class,$id);
        if($id!=null){
            header("Location: view_board.php?id=".$id."&s=1");
        }else{
            header("Location: board.php?class=".$class);
        }
    }
}