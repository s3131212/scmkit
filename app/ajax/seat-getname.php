<?php
header('Content-Type: application/json; charset=utf-8');
require_once(dirname(dirname(__FILE__)).'/AutoLoad.php');
AutoLoad::Load("Seat","get_name_json",array($_POST["num"],$_POST["class"]));