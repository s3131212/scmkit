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
    		<h1 class="title">教師區</h1>
    		<p>歡迎<% schoolname %>教師來到此教師專區，您可以在此分享的檔案給全校師生，觀看由全校學生上傳作業，以及輸入學生成績。</p>		
    	</section>
	</div>
</body>
</html>