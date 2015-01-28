<?php
if(!session_id()) session_start();
require_once(dirname(dirname(__FILE__)) . '/core/database.php');
//ini_set('display_errors', 'Off');
//error_reporting(0);
error_reporting(E_ALL);
if($_SESSION['login']!==true||$_SESSION['permission']!="student"){
	header("location:../");
	exit();
}