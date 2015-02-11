<html>
    <head>
    <title>編輯成績 - <% schoolname %> </title>
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
                    url: 'ajax/score-modify.php',
                    type: 'POST',
                    data: {
                        score: $('#score').val(),
                        id: <% id %>,
                        test: <% test %>
                    },
                    dataType:'json',
                    success: function(data){
                        $(".loading").hide();
                        if(data[0].status == true){
                            $(".alertcon").html('<div class="alert alert-success" style="display:none;">變更完成</div>');
                        }else{
                            $(".alertcon").html('<div class="alert alert-danger" style="display:none;">變更失敗</div>');
                        }
                        $(".alert").fadeIn(500).delay(2000).fadeOut(500);
                    },
                    error: function(){
                        $(".loading").hide();
                        $(".alertcon").html('<div class="alert alert-danger" style="display:none;">變更失敗</div>');
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
        <% nav | score %>
        <section class="content">
            <h1 class="title">變更成績</h1>
            <div class="breadcrumb">
                    <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Score
            </div>
            <div class="alertcon" style="height:60px;"></div>
            <h2><% student_name %> - <% test_name %></h2>
            <div class="score">
                <form role="form" method="post" action="score-modify.php?id=<% id %>&test=<% test %>">
       		        <div class="form-group">
    			        <label for="exampleInputEmail1">學生姓名</label>
    			        <input type="text" class="form-control" id="name" name="name" placeholder="學生姓名" disabled value="<% student_name %>">
  			        </div>
  			        <div class="form-group">
    			        <label for="exampleInputEmail1">成績</label>
    			        <input type="text" class="form-control" id="score" name="score" placeholder="學生成績" value="<% student_score %>">
  			        </div>
  			        <input type="submit" class="btn btn-default" id="submit" value="修改成績" />
                    <img src="../fonts/loading.gif" style="display:none; margin-left:10px;" class="loading" />
		        </form>  
            </div>
        </section>
    </div>
</body>
</html>