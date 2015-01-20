<?php 
class System_Controller {
    public function get_page(){
        $model = new System_Model;
        echo View::call_view("System",$model->get_data());
    }
    public function update_setting(){
        $model = new System_Model;
        $res = $model->update_setting();
        echo View::call_view("System",array_merge($model->get_data(),array("alert"=>'<div class="alert alert-success" style="margin-top:30px;">變更完成</div>')));
    }
}