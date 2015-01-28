<?php
if(!session_id()) session_start();
require_once(dirname(__FILE__) . '/core/database.php');
require_once(dirname(__FILE__) . '/core/path.php');
require_once(dirname(__FILE__) . '/core/systemloader.php');

$System = new System;
$System->apploader();

//header("Location:login.php");