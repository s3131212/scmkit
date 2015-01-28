<?php 
require_once('AutoLoad.php');
if(isset($_FILES["score"]) && $_FILES["score"]["error"]<1 && isset($_POST["name"]) && $_POST["name"] != null && isset($_POST["view_permission"]) && $_POST["view_permission"] != null){
    $id = AutoLoad::Load("Score","score_new",array($_FILES["file"],$_POST["view_permission"],$_POST["test_name"]));
    header("location:score_view.php?id=".$id);
}
AutoLoad::Load("Score","score_new_form",array("import"));