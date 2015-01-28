<?php
class Dashboard_Controller {
    public function load_dashboard(){
        echo Dashboard_View::load_dashboard();
    }
}