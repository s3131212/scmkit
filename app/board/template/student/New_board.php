<html>
    <head>
    <title>新增留言 - <% schoolname %> </title>
    <% header %>
    <script>
    function getQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
    $(function(){
        if(getQueryString("id")!=null){
            $("#form").attr('action','../new/?id='+getQueryString("id")+'&class='+getQueryString("class"));
        }else{
            $("#form").attr('action','../new/?id=&class='+getQueryString("class"));
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
            <h1 class="title">新增留言板</h1>
            <form action="new/?" id="form" method="post">
                <input type="text" id="title" name="title" placeholder="標題" value="" /><br />
                <textarea id="content" name="content">留言內容</textarea>
                <input type="submit" value="送出" />
            </form>

        </section>
    </div>
</body>
</html>