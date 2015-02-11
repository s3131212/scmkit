<?php 
class System_Controller {
    public function get_page(){
    	if(!checkpermission(array("staff"))){
            header("Location:index.php");
            exit();
        }
        $model = new System_Model;
        echo Template::call_view("system",$model->get_data());
    }
    public function update_setting(){
    	if(!checkpermission(array("staff"))){
            header("Location:index.php");
            exit();
        }
        $model = new System_Model;
        $res = $model->update_setting();
        echo Template::call_view("system",array_merge($model->get_data(),array("alert"=>'<div class="alert alert-success" style="margin-top:30px;">變更完成</div>')));
    }
}