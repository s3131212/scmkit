<html>
    <head>
    <title>新增行政人員資料 - <% schoolname %> </title>
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
        <h2 style="margin-top:30px;">新增行政人員</h2>
        <form class="form" action="new_staff.php" method="post">
            名稱：<input type="text" class="form-control" name="name" placeholder="名稱"></br>
            編號：<input type="text" class="form-control" name="id" placeholder="編號"></br>
            登入帳號：<input type="text" class="form-control" name="login_name" placeholder="帳號"></br>
            密碼：<input type="text" class="form-control" name="psd" placeholder="密碼"></br>
            <input type="submit" class="btn btn-default" value="送出" />
        </form>
    </section>
    </div>
</body>
</html>