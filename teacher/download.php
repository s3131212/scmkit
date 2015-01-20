<?php 
require_once('AutoLoad.php');
if($_GET['id'] != null) AutoLoad::Load("Tshare","tdownload",array($_GET["id"],$_SESSION["login_id"]));