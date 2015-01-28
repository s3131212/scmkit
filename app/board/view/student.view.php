<?php
class Board_View {
    public function list_board($data,$class){
        foreach ($data as $value) {
            $output .= "<div class='box'><h2><a href='../view?id=".$value["id"]."'>".$value["title"]."</a></h2><p>".$value["content"]."</p></div>";
        }
        echo Template::call_view(array("appname"=>"board","file"=>"Board"),array("data"=>$output,"class"=>$class));
    }
    public function view_board($main,$reply,$id,$class){
        $output .= "<h2>".$main["title"]."</h2><p>".$main["content"]."</p>";
        $output .= "<p class='q_footer'>由".$main["author"]."發表於".$main["create_time"]."</p>";
        $replyoutput = "";
        if(is_array($reply)){
            $replyoutput .= '<div class="box">';
            foreach ($reply as $value) {
                $replyoutput .= "<h3>".$value["title"]."</h3><p>".$value["content"]."</p>";
                $replyoutput .= "<p class='q_footer'>由".$value["author"]."發表於".$value["create_time"]."</p>";
            }
            $replyoutput .= '</div>';
        }
        echo Template::call_view(array("appname"=>"board","file"=>"View_board"),array("data"=>$output,"reply"=>$replyoutput,"class"=>$class,"arg"=>"id=".$id."&class=".$class));
    }
    public function new_board(){
        echo Template::call_view(array("appname"=>"board","file"=>"New_board"));
    }
}