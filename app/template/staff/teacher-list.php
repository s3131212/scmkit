<html>
    <head>
    <title>教師資料管理 - <% schoolname %></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/basic.js"></script>
    <script src="../javascripts/ajax_load.js"></script>
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
    <% nav | teacher_list %>
    <section class="content">
        <h1 class="title">教師資料管理</h1>
        <div class="box">
            <a href="teacher-new.php" class="btn btn-info" style="float:right;"><button>新增教師</button></a>
		    <% data %>
        </div>
    </section>
    </div>
</body>
</html>