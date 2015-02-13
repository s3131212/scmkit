<html>
    <head>
    <title>檢視學生資料 - <% schoolname %> </title>
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
        <% nav | student %>
    <section class="content">
        <h1 class="title">學生資料管理</h1>
        <div class="breadcrumb">
            <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Student
        </div>
        <div class="box">
            <h2><% name %></h2>
            <table class="table table-striped">
                <tr><td>學生名稱</td><td><% name %></td></tr>
                <tr><td>登入帳號</td><td><% login_name %></td></tr>
                <tr><td>住址</td><td><% address %></td></tr>
                <tr><td>電話</td><td><% phone %></td></tr>
                <tr><td>身分證字號</td><td><% personalid %></td></tr>
                <tr><td>入學學年度</td><td><% academic_year %></td></tr>
                <tr><td>Email</td><td><% email %></td></tr>
                <tr><td>班級</td><td><% class %></td></tr>
            </table>
        </div>
        <div class="box">
            <h3>請假紀錄</h3>
            <table><% leave %></table>
        </div>
        <div class="box">
            <h3>功過紀錄</h3>
            <table><% reward %></table>
        </div>
        <a href="#" onclick="window.history.forward()" class="btn btn-default"><button>回到列表</button></a>
    </section>
    </div>
</body>
</html>