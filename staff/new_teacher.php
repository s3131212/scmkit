<?php 
require_once('AutoLoad.php');
if(isset($_POST["name"])){
    AutoLoad::Load("Teacher","new_teacher",array($_POST["name"],$_POST["id"],$_POST["login_name"],$_POST["email"],$_POST["class"],$_POST["psd"]));
}
AutoLoad::Load("Teacher","new_teacher_form");