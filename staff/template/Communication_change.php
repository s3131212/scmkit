<html>
    <head>
    <title>編輯聯絡簿 - <% schoolname %> </title>
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/ajax_load.js"></script>
    <script src="../javascripts/basic.js"></script>
    <link rel="stylesheet" href="../css/datepicker.css">
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>
    <script>
        $(document).ready(function(){
        $("#submit").on("click",function(){
            event.preventDefault();
            $(".loading").show();
            $.ajax({
                url: "ajax/communication_change.php",
                type: "POST",
                data: {
                    date: '<% date %>',
                    class_id: '<% class_id %>',
                    empty: '<% empty %>',
                    content: $("#content").val()
                },
                dataType:"json",
                success: function(data){
                    $(".loading").hide();
                    if(data[0].status == true){
                        $(".alertcon").html('<div class="alert alert-success" style="display:none;">更新完成</div>');
                        $(".alert").fadeIn(500).delay(2000).fadeOut(500);
                    }else{
                        $(".alertcon").html('<div class="alert alert-danger" style="display:none;">發生預期之外的錯誤</div>');
                        $(".alert").fadeIn(500).delay(2000).fadeOut(500);
                    }
                    
                },
                error: function(){
                    $(".loading").hide();
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
        <% nav | communication %>
        <section class="content">
            <h1 class="title">教師區</h1>
            <div class="breadcrumb">
                    <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Contact Book
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div>
                    <div class="alertcon" style="height:60px;"></div>
                        <form method="post" class="form-inline" role="form" style="margin-top:10px;">
                            <h2><% class %>在<% date %>的聯絡簿</h2>
                            <textarea class="form-control" rows="10" name="content" id="content" style="width:100%;"><% content %></textarea>
                            <input type="submit" value="送出" class="btn btn-default" id="submit" style="margin-top:10px;">
                            <img src="../fonts/loading.gif" style="display:none; margin-left:10px;" class="loading" />
                        </form>
                    </div> 
                </div>
            </div>
        </section>
    </div>
</body>
</html>