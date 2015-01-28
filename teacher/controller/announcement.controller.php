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
			</blockquote></div>";
		}
		$table .= $this->create_nav($dataperpage,$nowpage,$data[1]);
		/*$output = file_get_contents(dirname(dirname(__FILE__)) . '/view/announcement.view.php');
        $output = str_replace("<% schoolname %>", $GLOBALS['schoolname'], $output);
        $output = str_replace("<% data %>", $table, $output);
        echo $output;*/
        echo View::call_view("Announcement",array("data"=>$table));
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