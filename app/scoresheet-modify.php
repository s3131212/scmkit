<?php 
require_once('AutoLoad.php');
if(isset($_POST["name"])) AutoLoad::Load("Score","scoresheet_modify",array($_POST["name"],$_POST["class"],$_POST["test"],$_GET["id"]));
AutoLoad::Load("Score","scoresheet_form",array($_GET["id"]));