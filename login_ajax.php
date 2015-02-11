<?php
if(!session_id()) session_start();
require_once(dirname(__FILE__) . '/core/database.php');
function login($username,$password,$permission){
	$password = md5($password);
	$res = $GLOBALS['db']->select($permission,array('login_name'=>$username,'password'=>$password));
	return is_array($res);
}
if(isset($_POST["username"])&&isset($_POST["password"])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	if(!isset($_POST["permission"])||$_POST["permission"]=="student"){
		$res = login($username, $password,"student");
		switch($res){
			case 0:	
				$output = '<div class="alert alert-warning">帳號或密碼錯誤</div>';
			break;

			case 1:
				$user = $GLOBALS['db']->select('student',array('login_name'=>$username));
				$_SESSION['login'] = true;
				$_SESSION['login_username'] = $username;
				$_SESSION['permission'] = "student";
				$_SESSION['login_id'] = $user[0]["id"];
				$_SESSION['login_name'] = $user[0]["name"];
				$_SESSION['class'] = $user[0]["class"];
				$output = "ok";
			break;

			default:
				$output = '<div class="alert alert-danger">系統錯誤，請通知資訊組</div>';
			break;
		}
	}

	if(isset($_POST["permission"])&&$_POST["permission"]=="teacher"){
		$res = login($username, $password,"teacher");
		switch($res){
			case 0:	
				$output = '<div class="alert alert-warning">帳號或密碼錯誤</div>';
			break;

			case 1:
				$teacher = $GLOBALS['db']->select('teacher',array('login_name'=>$username));
				$_SESSION['login'] = true;
				$_SESSION['login_username'] = $username;
				$_SESSION['permission'] = "teacher";
				$_SESSION['login_id'] = $teacher[0]["id"];
				$_SESSION['login_name'] = $teacher[0]["name"];
				$_SESSION['class'] = explode(",", $teacher[0]["class"]);
				array_pop($_SESSION['class']); array_shift($_SESSION['class']);
				$output = "ok";
			break;

			default:
				$output = '<div class="alert alert-danger">系統錯誤，請通知資訊組</div>';
			break;
		}
	}

	if(isset($_POST["permission"])&&$_POST["permission"]=="staff"){
		$res = login($username, $password,"staff");
		switch($res){
			case 0:	
				$output = '<div class="alert alert-warning">帳號或密碼錯誤</div>';
			break;

			case 1:
				$staff = $GLOBALS['db']->select('staff',array('login_name'=>$username));
				$_SESSION['login'] = true;
				$_SESSION['login_username'] = $username;
				$_SESSION['permission'] = "staff";
				$_SESSION['login_id'] = $staff[0]["id"];
				$_SESSION['login_name'] = $staff[0]["name"];
				$output = "ok";
			break;

			default:
				$output = '<div class="alert alert-danger">系統錯誤，請通知資訊組</div>';
			break;
		}
	}
}
echo $output;