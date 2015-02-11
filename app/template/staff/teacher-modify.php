<html>
    <head>
    <title>編輯教師資料 - <% schoolname %> </title>
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/ajax_load.js"></script>
    <script src="../javascripts/basic.js"></script>
    <script>
    function getQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
    
    $(document).ready(function(){ 
        if(getQueryString("s")=="1"){
            $(".alertcon").html('<div class="alert alert-success" style="display:none;">更新完成</div>');
            $(".alert").fadeIn(500).delay(2000).fadeOut(500);
        }
    });
    </script>
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
        <div class="alertcon" style="height:60px;"></div>
        <a href="teacher-import.php?id=<% id %>&method=delete" class="btn"><span class="glyphicon glyphicon-trash"></span>刪除教師</a>
        <form action="modify_teacher.php?id=<% id %>" method="post">
        <table class="table table-striped" style="margin-top:30px;">
            <tr><td>教師名稱</td><td><input type="text" class="form-control" id="name" name="name" placeholder="名稱" value="<% name %>"></td></tr>
            <tr><td>登入帳號</td><td><input type="text" class="form-control" id="login_name" name="login_name" placeholder="登入帳號" value="<% login_name %>"></td></tr>
            <tr><td>住址</td><td><input type="text" class="form-control" id="address" name="address" placeholder="住址" value="<% address %>"></td></tr>
            <tr><td>Email</td><td><input type="text" class="form-control" id="email" name="email" placeholder="電子郵件" value="<% email %>"></td></tr>
            <tr><td>電話</td><td><input type="text" class="form-control" id="phone" name="phone" placeholder="電話" value="<% phone %>"></td></tr>
        </table>
        班級：
        <select multiple class="form-control" id="class" name="class[]">
                <% option %>
        </select>
        <input type="submit" value="送出" class="btn btn-primary" id="submit" />
        </form>
        <a href="teacher-list.php" class="btn btn-default">回到列表</a>
    </section>
    </div>
</body>
</html>