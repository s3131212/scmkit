<?php 
require_once('AutoLoad.php');
AutoLoad::Load("Tshare","upload_file",array($_FILES,$_POST["view_permission"],$_SESSION["login_id"]));