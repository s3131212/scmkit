<?php 
require_once('AutoLoad.php');
AutoLoad::Load("Teacher","list_teacher",array("100",$_GET["page"]));