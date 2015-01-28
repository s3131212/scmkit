<?php 
require_once('AutoLoad.php');
if(isset($_POST["cur_1_1"])) AutoLoad::Load("Curriculum","update_curriculum",array($_GET["id"],$_POST,$_SESSION["class"]));
AutoLoad::Load("Curriculum","modify_table",array($_GET["id"],$_SESSION["class"]));