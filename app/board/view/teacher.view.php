<?php
class Board_View {
    public function list_board($class){
        $model = new Board_Model;
        $output = "";
        foreach ($model->list_board($class) as $value) {
            $output .= "<div class='box'><h2><a href='../view/?id=".$value["id"]."'>".$value["title"]."</a></h2><p>".$value["content"]."</p></div>";
        }
        echo Template::call_view(array("appname"=>"board","file"=>"Board"),array("data"=>$output,"class"=>$class));
    }
    public function list_class(){
        $model = new Board_Model;
        $output = "";
        foreach ($_SESSION["class"] as $value) {
            $output .= "<a href='list?class=".$value."'><button>".$model->get_class_data($value)."</button></a>";
        }
        echo Template::call_view(array("appname"=>"board","file"=>"Board_class"),array("data"=>$output));
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
        echo Template::call_view(array("appname"=>"board","file"=>"View_board"),array("data"=>$output,"reply"=>$replyoutput,"class"=>$res[0]["class"],"arg"=>"id=".$id."&class=".$res[0]["class"]));
    }
    public function new_board(){
        echo Template::call_view(array("appname"=>"board","file"=>"New_board"));
    }
}