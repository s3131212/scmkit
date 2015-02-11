<?php
if(!session_id()) session_start();
function get($var){
		return htmlspecialchars($_SESSION[$var]);
}
function checkpermission($allow,$allowlist = 0){
	if(!in_array($_SESSION["permission"], $allow)){
		return false;
	}
	if($allowlist != 0){
		if(count(array_diff(explode(",", $allowlist),$_SESSION["class"])) == count(explode(",", $allowlist))){
			return false;
		}
	}
	return true;
}