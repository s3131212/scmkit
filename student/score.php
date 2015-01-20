<?php 
require_once('AutoLoad.php');
AutoLoad::Load("Score","score_page",array($_SESSION["login_id"],$_SESSION["class"]));