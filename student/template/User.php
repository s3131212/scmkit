<html>
<head>
    <title>用戶資料 - <% schoolname %> </title>
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
    <% nav | user %>
        <section class="content">
            <h1 class="title">用戶資料</h1>
            <% alert %>
            <div class="box">
            <table class="table-head-l table table-striped">
                <tr><td>學生名稱</td><td><% name %></td></tr>
                <tr><td>登入帳號</td><td><% login_name %></td></tr>
                <tr><td>住址</td><td><% address %></td></tr>
                <tr><td>電話</td><td><% phone %></td></tr>
                <tr><td>身分證字號</td><td><% personalid %></td></tr>
                <tr><td>入學學年度</td><td><% academic_year %></td></tr>
                <tr><td>Email</td><td><% email %></td></tr>
                <tr><td>班級</td><td><% class %></td></tr>
                <tr><td>獎懲紀錄</td><td>大過：<% firstleveldemerit %>支，小過：<% secondleveldemerit %>支，警告：<% warning %>支，大功：<% firstcredit %>支，小功：<% secondcredit %>支，嘉獎：<% reward %>支</td></tr>
                <tr><td>請假</td><td><% leave %></td></tr>
            </table>
            </div>
            <div class="box">  
            <h2>變更密碼</h2>
                <form class="form-horizontal" role="form" method="post" action="user.php?id=<% id %>">
                    <div class="form-group">
                        <label for="psd" class="col-sm-2 control-label">請輸入新密碼</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="psd" name="psd" placeholder="請輸入新密碼">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="psd2" class="col-sm-2 control-label">請重新輸入密碼</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="psd2" name="psd2" placeholder="請重新輸入密碼">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-default" value="送出" />
                        </div>
                    </div>
                </form>
                </div>
            </section>
    </div>
</body>
</html>