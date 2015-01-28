<html>
    <head>
    <title>新增作業 - <% schoolname %> </title>
    <% header %>
    <script>
    function getQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
    $(function(){
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
        <% nav | homework %>
        <section class="content">
            <h1 class="title">學生資料管理</h1>
            <div class="breadcrumb">
                    <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Student
            </div>
            <div class="alertcon" style="height:60px;"></div>
            <h3>修改作業「<% name %>」</h3>
            <form action="?id=<% id %>" method="post">
                <table class="table table-striped" style="margin-top:30px;">
                    <tr><td>作業名稱</td><td><input type="text" class="form-control" id="name" name="name" placeholder="作業名稱" value="<% name %>"></td></tr>
                    <tr><td>開始繳交日期</td><td><input type="text" class="form-control" id="start_date" name="start_date" placeholder="請使用 yyyy/mm/dd 格式" value="<% start_date %>"></td></tr>
                    <tr><td>截止繳交日期</td><td><input type="text" class="form-control" id="end_date" name="end_date" placeholder="請使用 yyyy/mm/dd 格式" value="<% end_date %>"></td></tr>
                    <tr><td>簡介</td><td><textarea id="description" name="description"><% description %></textarea></td></tr>
                    <tr><td>參與班級</td><td><select id="class[]" name="class[]" multiple ><% option %></td></tr>
                </table>
                <input type="submit" value="送出" class="btn" id="submit" />
            </form><br />
        </section>
</div>
</body>
</html>