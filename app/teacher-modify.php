<?php 
require_once('AutoLoad.php');
if(isset($_POST["name"])){
    AutoLoad::Load("Teacher","update_info",array($_POST["name"],$_POST["login_name"],$_POST["address"],$_POST["phone"],$_POST["email"],$_POST["personalid"],$_POST["class"],$_GET["id"]));
}
if(isset($_GET["method"])&&$_GET["method"] == "delete"){
    AutoLoad::Load("Teacher","delete_teacher",array($_GET["id"]));
    header("location:teacher-list.php");
}
AutoLoad::Load("Teacher","update_info_form",array($_GET["id"]));