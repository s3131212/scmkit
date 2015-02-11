<?php 
require_once('AutoLoad.php');
if(isset($_POST["name"])){
    AutoLoad::Load("Homework","modify_homework",array($_POST["name"],$_POST['start_date'],$_POST["end_date"],$_POST["description"],$_POST["class"],$_GET["id"]));
}
AutoLoad::Load("Homework","modify_homework_form",array($_GET["id"]));