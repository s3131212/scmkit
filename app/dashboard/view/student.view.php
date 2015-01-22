<?php
class Dashboard_View {
    public function load_dashboard(){
        echo Template::call_view(array("appname"=>"dashboard","file"=>"Dashboard"));
    }
}