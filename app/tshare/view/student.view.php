<?php
class Tshare_View {
	public function tshare_list_table($data){
		$table = "";
		foreach($data as $d){
            $view_permission=explode(",", $d['view_permission']);
               $table .= "<tr><td>". $d['filename'] ."</td>
                <td>". $d["uploader"] ."</td>
                <td>". $d['upload_time'] ."</td>
                <td><a href=\"download/?id=". $d['id'] ."\" class=\"\"><button >下載</button></a></td>
                </tr>";
		}
		echo Template::call_view(array("appname"=>"tshare","file"=>"Tshare"),array("data"=>$table));
	}
}