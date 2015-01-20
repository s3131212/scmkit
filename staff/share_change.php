<?php 
require_once('AutoLoad.php');
if( isset($_GET["method"]) && $_GET["method"] == "delete" && isset($_GET["id"])) AutoLoad::Load("Tshare","share_change_action",array($_GET["id"],"","",1));
if(!isset($_POST["filename"])) AutoLoad::Load("Tshare","share_change_form",array($_GET["id"],$_SESSION["class"]));
elseif(isset($_POST["filename"]) && isset($_GET["id"]) && !isset($_GET["method"])) AutoLoad::Load("Tshare","share_change_action",array($_GET["id"],$_POST["view_permission"],$_POST["filename"],0));