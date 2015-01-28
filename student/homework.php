<?php 
require_once('AutoLoad.php');
AutoLoad::Load("Homework","homework_list",array($_SESSION['login_id']));