<html>
    <head>
    <title>用戶資料 - <% schoolname %> </title>
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/ajax_load.js"></script>
    <script src="../javascripts/basic.js"></script>
    <script>
    $(document).ready(function(){ 
        $("#submit").on("click",function(){
            event.preventDefault();
            $(".loading").show();
            $.ajax({
                url: "ajax/user.php",
                type: "POST",
                data: {
                    psd: $("#psd").val(),
                    psd2: $("#psd2").val(),
                    id: '<% id %>'
                },
                dataType:"json",
                success: function(data){
                    $(".alertcon").html(data[0].content);
                    $(".loading").hide();
                    $(".alert").fadeIn(500).delay(2000).fadeOut(500);
                }
            });
        });
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
    <% nav | user %>
    <section class="content">
        <h1 class="title">用戶資料</h1>
        <div class="breadcrumb">
            <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> User Information
        </div>
        <div class="alertcon" style="height:60px;"></div>
        <div class="box">
            <table class="table table-striped">
                <tr><td>名稱</td><td><% name %></td></tr>
                <tr><td>帳號</td><td><% login_name %></td></tr>
                <tr><td>地址</td><td><% address %></td></tr>
                <tr><td>電話</td><td><% phone %></td></tr>
            </table>
        </div>
        <h2>變更密碼</h2>
         <form class="form-horizontal" role="form" style="margin-top:30px;" method="post" action="user.php?id=<% id %>">
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
                        <input type="submit" class="btn btn-default" value="送出" id="submit" />
                        <img src="../fonts/loading.gif" style="display:none; margin-left:10px;" class="loading" />
                    </div>
                </div>
            </form>
        </section>
    </div>
</body>
</html>