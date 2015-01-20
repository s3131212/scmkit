<?php 
if(!session_id()) session_start();
//ini_set('display_errors', 'Off');
//error_reporting(0);
error_reporting(E_ALL);
require_once(dirname(dirname(__FILE__)) . '/core/database.php');
$GLOBALS['schoolname']=$GLOBALS['db']->select("setting", array("name" => "schoolname"));
$GLOBALS['schoolname']=$GLOBALS['schoolname'][0]["value"];
if($_SESSION['login']!==true||$_SESSION['permission']!="teacher"){
	header("location:../");
	exit();
}