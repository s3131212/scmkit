<?php 
require_once('AutoLoad.php');
if($_GET['id'] != null) AutoLoad::Load("Homework","hdownload",array($_GET["id"]));