<?php 
require_once('AutoLoad.php');
if(isset($_POST["content"])) AutoLoad::Load("Board","new_board",array($_POST["title"],$_POST["content"],$_SESSION["class"],$_GET["id"])); 
AutoLoad::Template("New_board"); 