<html>
    <head>
    <title>檢視教師資料 - <% schoolname %> </title>
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
    <% nav | teacher_list %>
    <section class="content">
        <h1 class="title">教師資料管理</h1>
        <div class="box">
            <table class="table table-striped">
                <tr><td>教師名稱</td><td><% name %></td></tr>
                <tr><td>登入帳號</td><td><% login_name %></td></tr>
                <tr><td>住址</td><td><% address %></td></tr>
                <tr><td>電話</td><td><% phone %></td></tr>
                <tr><td>Email</td><td><% email %></td></tr>
                <tr><td>身分證字號</td><td><% personalid %></td></tr>
                <tr><td>班級</td><td><% class %></td></tr>
            </table>
        </div>
        <a href="teacher-list.php" class="btn btn-default"><button>回到列表</button></a>
    </section>
    </div>
</body>
</html>