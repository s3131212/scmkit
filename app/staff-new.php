<?php 
require_once('AutoLoad.php');
if(isset($_POST["name"])){
    AutoLoad::Load("Staff","new_staff",array($_POST["name"],$_POST["id"],$_POST["login_name"],$_POST["academic_year"],$_POST["psd"]));
    header("Location:staff-list.php");
}
AutoLoad::Template("New_staff");