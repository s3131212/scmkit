<?php
class Staff_Controller {
	public function list_staff(){
        $model = new Staff_Model;
		$table = '<table class="table table-striped"><thead><td>姓名</td><td>登入ID</td><td>動作</td></thead>';
		foreach($model->list_staff() as $d){ 
			$table .= "<tr><td>".$d["name"]."</td>
			<td>".$d["login_name"]."</td>
			<td><a href='view_staff.php?id=".$d["id"]."' class='btn'><button>檢視</button></a>
			<a href='modify_staff.php?id=".$d["id"]."' class='btn'><button>變更</button></a></td>";
		}
		$table .= "</table>";
		echo View::call_view("Staff_list",array("data"=>$table));
	}
    public function view_info($id){
        $model = new Staff_Model;
        $res = $model->get_info($id);
        echo View::call_view("View_staff",array("name"=>$res["name"],"login_name"=>$res["login_name"],"address"=>$res["address"],"phone"=>$res["phone"]));
    }
    public function update_info_form($id){
        $model = new Staff_Model;
        $res = $model->get_info($id);
        echo View::call_view("Modify_staff",array("name"=>$res["name"],"login_name"=>$res["login_name"],"address"=>$res["address"],"phone"=>$res["phone"],"id"=>$id));
    }
	public function update_info($name,$login_name,$address,$phone,$id){
        $model = new Staff_Model;
    	$model->update_info($name,$login_name,$address,$phone,$id);
        header("Location:modify_staff.php?id=".$id."&s=1");
	}
	public function new_staff($name,$id,$login_name,$psd){
		$model = new Staff_Model;
        $model->new_staff($name,$id,$login_name,$psd);
	}
    public function delete_staff($id){
        $model = new Staff_Model;
        $model->delete_staff($id);
    }
}