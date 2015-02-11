<html>
    <head>
    <title>管理行政人員 - <% schoolname %> </title>
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
        <% nav | staff_list %>
    <section class="content">
        <h1 class="title">行政人員資料管理</h1>
        <div class="box">
            <a href="staff-new.php" class="btn btn-info" style="float:right;"><button>新增行政人員</button></a>
		    <% data %>
        </div>
    </section>
    </div>
</body>
</html>