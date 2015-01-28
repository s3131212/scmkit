<?php
class Announcement_Controller {
    public function list_content($dataperpage,$nowpage){
        $table = "";
        if($nowpage != null && $nowpage != "1"){
            $offset = ($nowpage-1)*$dataperpage;
            $offset = $offset.", " . $dataperpage;
        }else $offset="0, " . $dataperpage;
        $model = new Announcement_Model;
        $data = $model->list_content($dataperpage,$nowpage,$offset);
        foreach($data[0] as $d){ 
            $table .= "<div class='box'><h3>". $d["title"] ."</h3>
            <blockquote>". $d["content"] ."
            <footer style=\"text-align:right;\"> - ". $d["date"] ." , ". $d["name"] ."</footer>
            </blockquote>
            <a href=\"modify_announcement.php?id=". $d["id"] ."\" class=\"btn btn-link\">修改公告</a>
            <a href=\"modify_announcement.php?id=". $d["id"] ."&mode=delete\" class=\"btn btn-link\">刪除公告</a></div>";
        }
        $table .= $this->create_nav($dataperpage,$nowpage,$data[1]);
        echo View::call_view("Announcement",array("data"=>$table));
    }

    public function change_data_table($id = ""){
        $model = new Announcement_Model;
        if($id!="new"){
            $res = $model->get_data($id);
            $content = str_replace("<br />",chr(13).chr(10),$res[0]["content"]);
            echo View::call_view("Modify_announcement",array("head"=>"您正在修改「".$res["title"]."」的內容","title"=>$res["title"],"content"=>$res["content"],"id"=>$id));
        }else{
            echo View::call_view("Modify_announcement",array("head"=>"新增公告","title"=>"","content"=>"","id"=>"new"));
        }
    }

	public function change_data($id = "",$content,$title,$new,$author){
		$content = htmlspecialchars($content);
        $content = nl2br($content);
    	$title = htmlspecialchars($title);
        $model = new Announcement_Model;
        echo json_encode(array(array("status"=>$model->modify_announcement($id,$content,$title,$new,$author))));
	}

    public function delete_announcement($id){
        $model = new Announcement_Model;
        $alert = $model->delete_announcement($id);
        header("Location:announcement.php");
    }

    private function create_nav($dataperpage,$nowpage,$num){
        if($num > $dataperpage) $num=floor($num/$dataperpage);
        else $num = 1;
        if($num>1){
            $page=1;
            $nav = '<ul class="pagination">';
            if($nowpage==null) $nowpage="1";
            while($page<=$num){
                if($nowpage==$page) $nav .= '<li class="active"><a href="announcement.php?page='.$page.'">'.$page.'</a></li>';
                else $nav .= '<li><a href="announcement.php?page='.$page.'">'.$page.'</a></li>';
                $page++;
            }
            $nav .= "</ul>";
        }else $nav = ""; 
        return $nav;
    }
}