<?php 
require_once('AutoLoad.php');
AutoLoad::Load("Tshare","tshare_list_table",array($_SESSION["login_id"]));