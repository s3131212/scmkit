<?php
class User_View {
    public function get_data($id){
        $model = new User_Model;
        $array = $model->get_data($id);
        echo Template::call_view(array("appname"=>"user","file"=>"User"),$array);
    }
}