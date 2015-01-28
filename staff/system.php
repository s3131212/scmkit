<?php 
require_once('AutoLoad.php');
if(isset($_POST["schoolname"])){
    AutoLoad::Load("System","update_setting");
}else{
    AutoLoad::Load("System","get_page");
}