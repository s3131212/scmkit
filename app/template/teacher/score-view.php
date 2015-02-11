<html>
    <head>
    <title>檢視成績 - <% schoolname %> </title>
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/ajax_load.js"></script>
    <script src="../javascripts/basic.js"></script>
    <script src="../javascripts/Chart.min.js"></script>
    <script>
    $(document).ready(function(){ 
        <% js %>
        $(".score_class_chart").css("width",$('.score_right').width()-100).css("height",$('.score_left').height()-100); //高度以左邊欄位高度為主
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
            <h1 class="title">成績查詢</h1>
            <div class="breadcrumb">
                    <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Score
            </div>
            <h2><% name %></h2>
            <a href="test-modify.php?id=<% id %>" class="btn" ><button>修改考試內容</button></a>
            <% data %>
        </section>
    </div>
</body>
</html>