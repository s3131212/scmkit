<?php 
require_once('AutoLoad.php');
if(isset($_POST["name"]) &&  isset($_POST["score"]) && isset($_POST["view_permission"]) && $_POST["name"] != null  && $_POST["score"] != null  && $_POST["view_permission"] != null){
    $id = AutoLoad::Load("Score","score_new",array($_POST["name"],$_POST["score"],$_POST["view_permission"],$_POST["test_name"]));
    header("location:score_view.php?id=".$id);
}
AutoLoad::Load("Score","score_new_form",array("new"));