<?php 
require_once(dirname(dirname(__FILE__)).'/AutoLoad.php');
AutoLoad::Load("Communication","get_content_json",array($_POST["date"]));