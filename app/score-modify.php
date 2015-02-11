<?php 
require_once('AutoLoad.php');
AutoLoad::Load("Score","update_score_table",array($_GET["test"],$_GET["id"]));