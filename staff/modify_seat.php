<?php 
require_once('AutoLoad.php');
if(isset($_POST["num_1_1"])&&$_POST["num_1_1"]!=null) AutoLoad::Load("Seat","modify_seat",array($_POST,$_GET["id"]));
AutoLoad::Load("Seat","list_modify_table",array($_GET["id"]));