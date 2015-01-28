<?php 
header('Content-Type: application/json; charset=utf-8');
require_once(dirname(dirname(__FILE__)).'/AutoLoad.php');
AutoLoad::Load("Class","update_name",array($_POST["class_grade"],$_POST['class_name'],$_POST["id"]));