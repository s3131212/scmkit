<?php
class Announcement_View {
    public function score_page($score,$scoresheet){
        echo Template::call_view(file_get_contents(dirname(dirname(__FILE__)).'/template/student/Score.php'),array("score" => Score_View::student_list_score($score),"scoresheet" => Score_View::list_scoresheet($scoresheet)));
    }
    public function list_data($data,$dataperpage,$nowpage,$num){
        $table = "";
        foreach($data as $d){ 
            $table .= "<div class='box'><h3>". $d["title"] ."</h3>
            <blockquote>". $d["content"] ."
            <footer style=\"text-align:right;\"> - ". $d["date"] ." , ". $d["name"] ."</footer>
            </blockquote></div>";
        }
        $table .= Announcement_View::create_nav($dataperpage,$nowpage,$num);
        echo Template::call_view(array("appname"=>"announcement","file"=>"Announcement"),array("data" => $table));
    }
    private function create_nav($dataperpage,$nowpage,$num){
        if($num > $dataperpage) $num = floor($num/$dataperpage);
        else $num = 1;
        if($num>1){
            $page=1;
            $nav = '<ul class="pagination">';
            if($nowpage == null) $nowpage="1";
            while($page<=$num){
                if($nowpage==$page) $nav .= '<li class="active"><a href="?page='.$page.'">'.$page.'</a></li>';
                else $nav .= '<li><a href="?page='.$page.'">'.$page.'</a></li>';
                $page++;
            }
            $nav .= "</ul>";
        }else $nav = ""; 
        return $nav;
    }
}