<html>
<head>
    <title>班級管理 - <% schoolname %></title>
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
                url: "ajax/class-modify.php",
                type: "POST",
                data: {
                    class_grade: $("#class_grade").val(),
                    class_name: $("#class_name").val(),
                    id: '<% id %>'
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
    <% nav | class %>
    <section class="content">
        <h1 class="title">班級管理</h1>
        <h2><% grade %>年<% name %>班</h2>
        <div class="alertcon" style="height:60px;"></div>
        <h3>變更班級名稱</h3>
       	<form action="class-modify.php?id=<% id %>" method="post" class="form-horizontal">
        <div class="form-group">
          	<label for="class_grade" class="col-sm-2 control-label">班級名稱</label>
        	<div class="col-sm-10">
            	<input type="text" class="form-control" id="class_grade" name="class_grade" placeholder="年級" value="<% grade %>" style="width:10%; display:inline;"> 年
            	<input type="text" class="form-control" id="class_name" name="class_name" placeholder="班級名稱" value="<% name %>" style="width:10%; display:inline;"> 班
        	</div>
        </div>
        <input type="submit" value="送出" class="btn btn-primary" id="submit" />
        <img src="../fonts/loading.gif" style="display:none; margin-left:10px;" class="loading" />
       	</form>
        <h3>此班學生</h3>
        <table class="table table-striped">
            <thead><td>名稱</td><td>管理</td></thead>
            <% data %>
        </table>
        <a href="class-modify.php?id=<% id %>&method=delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>刪除班級</a>
    </section>
    </div>
</body>
</html>