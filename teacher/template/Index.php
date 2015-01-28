<html>
    <head>
    <title><% schoolname %> </title>
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
            <div class="breadcrumb">
                    <i class="fa fa-home"></i> Home
            </div>
			<h2>教師區</h2>
			<div class="announcement">
				<p>歡迎來到<% schoolname %>管理系統教師專區，您可以在此快速新增、修改聯絡簿，分享的檔案給學生，觀看由學生上傳作業，以及輸入學生成績。</p>
			</div>
		</section>
	</div>				
</body>
</html>