<?php
if(!session_id()) session_start();
require_once(dirname(__FILE__) . '/core/database.php');
$schoolname=$db->select("setting", array("name" => "schoolname"));
$err = "";
function login($username,$password,$permission){
	$password=md5($password);
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
				$err='<div class="alert alert-warning">帳號或密碼錯誤</div>';
			break;

			case 1:
				$user=$db->select('student',array('login_name'=>$username));
				$_SESSION['login'] = true;
				$_SESSION['login_username'] = $username;
				$_SESSION['permission'] = "student";
				$_SESSION['login_id'] = $user[0]["id"];
				$_SESSION['login_name'] = $user[0]["name"];
				$_SESSION['class'] = $user[0]["class"];
				header("Location: student/");
			break;

			default:
				$err='<div class="alert alert-danger">系統錯誤，請通知資訊組</div>';
			break;
		}
	}

	if(isset($_POST["permission"])&&$_POST["permission"]=="teacher"){
		$res = login($username, $password,"teacher");
		switch($res){
			case 0:	
				$err='<div class="alert alert-warning">帳號或密碼錯誤</div>';
			break;

			case 1:
				$teacher=$db->select('teacher',array('login_name'=>$username));
				$_SESSION['login'] = true;
				$_SESSION['login_username'] = $username;
				$_SESSION['permission'] = "teacher";
				$_SESSION['login_id'] = $teacher[0]["id"];
				$_SESSION['login_name'] = $teacher[0]["name"];
				$_SESSION['class'] = explode(",", $teacher[0]["class"]);
				header("Location: teacher/");
			break;

			default:
				$err='<div class="alert alert-danger">系統錯誤，請通知資訊組</div>';
			break;
		}
	}

	if(isset($_POST["permission"])&&$_POST["permission"]=="staff"){
		$res = login($username, $password,"staff");
		switch($res){
			case 0:	
				$err='<div class="alert alert-warning">帳號或密碼錯誤</div>';
			break;

			case 1:
				$staff=$db->select('staff',array('login_name'=>$username));
				$_SESSION['login'] = true;
				$_SESSION['login_username'] = $username;
				$_SESSION['permission'] = "staff";
				$_SESSION['login_id'] = $staff[0]["id"];
				$_SESSION['login_name'] = $staff[0]["name"];
				$_SESSION['class'] = $staff[0]["class"];
				header("Location: staff/");
			break;

			default:
				$err='<div class="alert alert-danger">系統錯誤，請通知資訊組</div>';
			break;
		}
	}
}
?>
<html>
<head>
		<link rel="stylesheet" href="stylesheets/style.css">
		<script src="javascripts/bootstrap.min.js"></script>
		<script src="javascripts/jquery.min.js"></script>
		<title><?php echo $schoolname[0]["value"]; ?></title>
</head>
<body>
    <div class="container hero">
        <div class="middle">
            <header class="hero-title">
                <h1 class="logo">
                    <span class="logo-school"><?php echo $schoolname[0]["value"]; ?></span>
                </h1>
            </header>
        	<?php echo $err; ?>
        		<h2>Student Login</h2>
        		<form method="post" id="form" action="login.php">
                	<div class="input-group input-group-lg">
                    <span class="input-group-addon">Username</span>
                    <input type="text" required class="form-control input-lg" id="username" name="username" placeholder="Username">
                	</div>
                	<div class="input-group input-group-lg">
                    <span class="input-group-addon">Password</span>
                    <input type="password" required class="form-control input-lg" id="password" name="password" placeholder="Password">
                	</div>
                    <div class="input-group input-group-lg">
                    <input type="radio" name="permission" id="permission" value="student" checked="checked"> 學生 &nbsp;&nbsp;
                    <input type="radio" name="permission" id="permission" value="teacher"> 教師 &nbsp;&nbsp;
                    <input type="radio" name="permission" id="permission" value="staff"> 行政人員 
                    </div>
              	<input type="submit" value="Submit" class="btn" />
            	</form>
        </div>
	</div>
</body>
</html>
