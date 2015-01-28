<?php 
require_once('AutoLoad.php');
AutoLoad::Load("Communication","get_editor_data",array($_GET["empty"],$_GET['class'],$_GET["date"]));