<html>
    <head>
    <title>學校公告 - <% schoolname %></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/basic.js"></script>
    <script src="../javascripts/ajax_load.js"></script>
    <script>
        $(document).ready(function(){ 
            $("#submit").on("click",function(){
                event.preventDefault();
                $(".loading").show();
                $.ajax({
                    url: 'ajax/modify_announcement.php',
                    type: 'POST',
                    data: {
                        title: $('#title').val(),
                        content: $('#content').val(),
                        id: '<% id %>'
                    },
                    dataType:'json',
                    success: function(data){
                        $(".loading").hide();
                        if(data[0].status == true){
                            $(".alertcon").html('<div class="alert alert-success" style="display:none;">更新完成</div>');
                            $(".alertcon").append('<iframe src="mail_notification.php?type=announcement&title=' + $("#title").val() + '" style="height:1px; width:1px; opacity:0.1; -moz-opacity:0.1;"></iframe>');
                        }else{
                            $(".alertcon").html('<div class="alert alert-danger" style="display:none;">更新失敗</div>');
                        }
                        $(".alert").fadeIn(500).delay(2000).fadeOut(500);
                    },
                    error: function(){
                        $(".alertcon").html('<div class="alert alert-danger" style="display:none;">更新失敗</div>');
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
        <% nav | announcement %>
    <section class="content">
        <div>
            <div class="alertcon" style="height:60px;"></div>
            <form method="post" role="form" action="modify_announcement.php?id=<% id %>" style="margin-top:30px;">
                    <h2><% head %></h2>
                    <label for="title">標題</label>
                    <input type="text" class="form-control" name="title" id="title" style="width:100%;" value="<% title %>" />
                    <label for="content">內容</label>
                    <textarea class="form-control" rows="10" name="content" id="content" style="width:100%;"><% content %></textarea>
                    <input type="submit" value="送出" class="btn btn-default" id="submit" />
                    <img src="../fonts/loading.gif" style="display:none; margin-left:10px;" class="loading" />
            </form>
        </div>
    </section>
    </div>
</body>
</html>