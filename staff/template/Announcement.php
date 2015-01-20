<html>
    <head>
    <title>學校公告 - <% schoolname %></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/basic.js"></script>
    <script src="../javascripts/ajax_load.js"></script></head>
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
    <% nav | announcement %>
    <section class="content">
        <h1 class="title">學校公告</h1>
		<a href="modify_announcement.php?id=new" class="btn btn-info" style="float:right;">新增公告</a>
		<div class="announcement">
		<% data %>
	    </div>
    </section>
    </div>
</body>
</html>