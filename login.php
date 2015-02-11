<html>
<head>
		<title> 神秘測試學校 </title>
	    <link rel="stylesheet" href="stylesheets/style.css">
	    <script src="javascripts/jquery.min.js"></script>
	    <script src="javascripts/ajax_load.js"></script>
	    <script src="javascripts/basic.js"></script>
		<title><% schoolname %></title>
		<script type="text/javascript">
		$(document).ready(function(){
			$('#submitbtn').on('click',function (e){
				e.preventDefault();
				$.ajax({
	                url: 'login_ajax.php',
	                type: 'POST',
	                data: {
	                	username: $('#username').val(),
	                	password: $('#password').val(),
	                    permission: $('input[name=permission]:checked').val()
	                },
	                dataType:'html',
	                success: function(data){
	                	if(data == "ok"){
	                		window.location.href = "app/index.php";
	                	}else{
	                    	$('.error_container').html(data);
	                    }
	                }
	            });
			});
		});
		</script>
</head>
<body>
    <div class="container hero">
        <div class="middle">
            <header class="hero-title">
                <h1 class="logo">
                    <span class="logo-school"><% schoolname %></span>
                </h1>
            </header>
			<div class="error_container"></div>
        		<h2>Student Login</h2>
        		<form method="post" id="form">
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
              	<input type="submit" value="Submit" class="btn" id="submitbtn" />
            	</form>
        </div>
	</div>
</body>
</html>
