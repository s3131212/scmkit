<?php 
require_once('AutoLoad.php');
if(isset($_POST["psd"]) && isset($_POST["psd2"]) && $_GET["id"] == $_SESSION["login_id"]){
    AutoLoad::Load("User","set_pass",array($_POST["psd"],$_POST["psd2"],$_SESSION['login_id']));
}else{
    AutoLoad::Load("User","get_data",array($_SESSION['login_id']));
}