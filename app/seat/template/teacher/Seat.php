<html>
    <head>
    <title>座位表 - <% schoolname %> </title>
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
        <% nav | seat %>
        <section class="content">
            <h1 class="title">座位表</h1>
            <div class="breadcrumb">
                    <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Seat
            </div>
            <div class="alertcon" style="height:60px;"></div>
            <% data %>
        </section>    
    </div>
</body>
</html>