<html>
<head>
    <title> <% schoolname %> </title>
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/ajax_load.js"></script>
    <script src="../javascripts/basic.js"></script>
</head>
<body>
    <header class="head">
        <div class="folder">
            <i class="fa fa-bars"></i>
        </div>
        <h1 class="logo">
            <span class="logo-school"><% schoolname %></span>
        </h1>
        <div class="user">
            <div class="user-title">
                <% username %>
            </div>
            <div class="user-link">
                <a href="logout.php" class="link">Logout</a>
            </div>
        </div>
    </header>
	<div class="container">
	   <% nav | index %>
    	<section class="content">
    		<h1 class="title">學生區</h1>
    		<p>歡迎<% schoolname %>學生來到此管理系統學生專區。</p>		
    	</section>
	</div>
</body>
</html>