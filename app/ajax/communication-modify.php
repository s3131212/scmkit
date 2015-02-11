<?php 
require_once(dirname(dirname(__FILE__)).'/AutoLoad.php');
AutoLoad::Load("Communication","update_communication",array($_POST["empty"],$_POST['class_id'],$_POST["content"],$_POST["date"]));