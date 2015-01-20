<?php 
require_once('AutoLoad.php');
AutoLoad::Load("Homework","hdownload",array($_GET["id"],$_SESSION["class"]));