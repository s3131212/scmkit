<?php 
header('Content-Type: application/json; charset=utf-8');
require_once(dirname(dirname(__FILE__)).'/AutoLoad.php');
AutoLoad::Load("Class","new_class_cross",array($_POST["class_grade"],$_POST["class_name"]));
$alert = '<div class="alert alert-success" style="display:none;">變更完成</div>';
$json=array(array("content"=>$alert));
echo json_encode($json);