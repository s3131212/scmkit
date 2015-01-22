<?php
class User_View {
    public function get_data($data){
        echo Template::call_view(array("appname"=>"user","file"=>"User"),$data);
    }
}