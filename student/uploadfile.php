<?php 
require_once('AutoLoad.php');
AutoLoad::Load("Homework","upload_file",array($_FILES,$_GET["id"]));