<?php 
require_once('AutoLoad.php');
if(isset($_GET["date"])) AutoLoad::Load("Communication","get_content",array($_SESSION['class'],$_GET["date"]));
else AutoLoad::Load("Communication","get_content",array($_SESSION['class']));