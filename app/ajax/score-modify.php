<?php 
header('Content-Type: application/json; charset=utf-8');
require_once(dirname(dirname(__FILE__)).'/AutoLoad.php');
echo json_encode(array(array("content"=>AutoLoad::Load("Score","update_score",array($_POST["test"],$_POST["id"],$_POST["score"])))));