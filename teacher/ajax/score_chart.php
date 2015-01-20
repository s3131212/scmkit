<?php 
header('Content-Type: application/json; charset=utf-8');
require_once(dirname(dirname(__FILE__)).'/AutoLoad.php');
echo AutoLoad::Load("Score","score_chart",array($_POST["id"]));