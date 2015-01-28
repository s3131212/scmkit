<html>
    <head>
    <title>留言板 - <% schoolname %> </title>
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
    <% nav | board %>
        <section class="content">
            <div class="alertcon" style="height:60px;"></div>
            <h1 class="title">留言板</h1>
            <a href="../new/?<% arg %>"><button>新增回應</button></a><a href="../list/?class=<% class %>"><button>回到留言板</button></a>
            <div class="box"><% data %></div>
            <% reply %>
        </section>
    </div>
</body>
</html>