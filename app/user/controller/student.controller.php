<?php
class User_Controller {
    public function get_data($id){
        $model = new User_Model;
        if(isset($_POST["psd"])){
            $this->set_pass($_POST["psd"],$_POST["psd2"],$_SESSION["login_id"]);
        }else{
            echo User_View::get_data($model->get_data($id));
        }
    }
    public function set_pass($psd,$psd2,$id){
        $model = new User_Model;
        if($psd != NULL && $psd == $psd2){
            $model->set_pass($psd,$id);
            $alert = '<div class="alert alert-success" style="margin-top:30px;">密碼變更完成</div>';
        }elseif($psd == NULL){
            $alert = '<div class="alert alert-danger" style="margin-top:30px;">請輸入密碼</div>';
        }elseif($psd != $_POST["psd2"]){
            $alert = '<div class="alert alert-danger" style="margin-top:30px;">兩次輸入的密碼不同</div>';
        }
        $array = $model->get_data($id);
        echo User_View::get_data(array_merge($array,array("alert"=>$alert)));
    }
}