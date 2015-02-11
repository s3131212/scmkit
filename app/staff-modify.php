<?php 
require_once('AutoLoad.php');
if(isset($_POST["name"])){
    AutoLoad::Load("Staff","update_info",array($_POST["name"],$_POST["login_name"],$_POST["address"],$_POST["phone"],$_GET["id"]));
}
if(isset($_GET["method"])&&$_GET["method"] == "delete"){
    AutoLoad::Load("Staff","delete_staff",array($_GET["id"]));
    header("location:staff-list.php");
}
AutoLoad::Load("Staff","update_info_form",array($_GET["id"]));