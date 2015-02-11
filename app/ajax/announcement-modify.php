<?php 
if(!session_id()) session_start();
header('Content-Type: application/json; charset=utf-8');
require_once(dirname(dirname(__FILE__)).'/AutoLoad.php');
if($_POST["id"]!="new") AutoLoad::Load("Announcement","change_data",array($_POST["id"],$_POST["content"],$_POST["title"],false,$_SESSION["login_id"]));
else AutoLoad::Load("Announcement","change_data",array("",$_POST["content"],$_POST["title"],true,$_SESSION["login_id"]));