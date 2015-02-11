<?php
class User_Controller {
    public function get_data($id){
        $model = new User_Model;
        $array = $model->get_data($id);
        echo Template::call_view("user",$array);
    }
    public function set_pass($psd,$psd2,$id){
        if($psd != NULL && $psd == $psd2){
            $model = new User_Model;
            $model->set_pass($psd,$id);
            $alert = '<div class="alert alert-success" style="margin-top:30px; display:none;">密碼變更完成</div>';
        }elseif($psd == NULL){
            $alert = '<div class="alert alert-danger" style="margin-top:30px; display:none;">請輸入密碼</div>';
        }elseif($psd != $_POST["psd2"]){
            $alert = '<div class="alert alert-danger" style="margin-top:30px; display:none;">兩次輸入的密碼不同</div>';
        }
        echo json_encode(array(array("content"=>$alert)));  
    }
}