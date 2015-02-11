<?php 
require_once('AutoLoad.php');
if($_GET["delete"]=="true"){
    AutoLoad::Load("Score","delete_test",array($_GET["id"]));
    header("Location:score.php");
}
if(isset($_POST["name"])) AutoLoad::Load("Score","test_modify",array($_GET["id"],$_POST["name"],$_POST["view_permission"]));
AutoLoad::Load("Score","test_modify_form",array($_GET["id"]));