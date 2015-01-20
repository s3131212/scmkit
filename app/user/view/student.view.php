<?php
class User_View {
    public function get_data($data){
        echo Template::call_view(array("appname"=>"user","file"=>"User"),$data);
    }
    public function set_pass($psd,$psd2,$id){
        if($psd != NULL && $psd == $psd2){
            $model = new User_Model;
            $model->set_pass($psd,$id);
            $alert = '<div class="alert alert-success" style="margin-top:30px;">密碼變更完成</div>';
        }elseif($psd == NULL){
            $alert = '<div class="alert alert-danger" style="margin-top:30px;">請輸入密碼</div>';
        }elseif($psd != $_POST["psd2"]){
            $alert = '<div class="alert alert-danger" style="margin-top:30px;">兩次輸入的密碼不同</div>';
        }
        $array = $model->get_data($id);
        echo View::call_view("User",array_merge($array,array("alert"=>$alert)));
    }
}