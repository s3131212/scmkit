<?php 
require_once('AutoLoad.php');
AutoLoad::Load("User","get_data",array($_SESSION["login_id"]));