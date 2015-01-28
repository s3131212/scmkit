<?php 
require_once(dirname(dirname(__FILE__)) . '/AutoLoad.php');
header('Content-Type: application/json; charset=utf-8');
AutoLoad::Load("Communication","get_content_json",array($_POST["date"]));