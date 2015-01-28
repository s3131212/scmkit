<?php
if(!session_id()) session_start();
//ini_set('display_errors', 'Off');
//error_reporting(0);
error_reporting(E_ALL);
if($_SESSION['login']!==true||$_SESSION['permission']!="staff"){
	header("location:../");
	exit();
}