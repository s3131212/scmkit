<?php 
require_once('AutoLoad.php');
if(isset($_POST["name"])){
    $id = AutoLoad::Load("Homework","new_homework",array($_POST["name"],$_POST['start_date'],$_POST["end_date"],$_POST["description"],$_POST["class"]));
    header("Location:homework_view.php?id=".$id);
}
AutoLoad::Load("Homework","new_homework_form");