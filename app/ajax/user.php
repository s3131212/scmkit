<?php 
header('Content-Type: application/json; charset=utf-8');
require_once(dirname(dirname(__FILE__)).'/AutoLoad.php');
AutoLoad::Load("User","set_pass",array($_POST["psd"],$_POST["psd2"],$_POST["id"]));