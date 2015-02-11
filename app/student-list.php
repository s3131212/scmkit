<?php 
require_once('AutoLoad.php');
AutoLoad::Load("Student","list_student",array(100,$_GET["page"],$_GET["class"]));