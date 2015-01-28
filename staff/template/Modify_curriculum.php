<html>
    <head>
    <title>課表 - <% schoolname %> </title>
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
        <% nav | curriculum %>
        <section class="content">
            <h1 class="title">課表</h1>
            <div class="breadcrumb">
                    <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Curriculum
            </div>
            <div class="alertcon" style="height:60px;"></div>
            <form action="modify_curriculum.php?id=<% id %>" method="post">
            <% data %>
            <input type="submit" value="送出" />
            </form>
        </section>    
    </div>
</body>
</html>