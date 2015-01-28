<html>
    <head>
    <title>檢視成績 - <% schoolname %> </title>
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/ajax_load.js"></script>
    <script src="../javascripts/basic.js"></script> 
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
            <div class="box box-6">
                <h3>成績</h3>
                <table class="score">
                    <thead><td>Name</td><td>View/Modify</td></thead>
                    <% score %>
                </table>
            </div>
            <div class="box box-6">
                <h3>成績單</h3>
                <a href="scoresheet_modify.php?id=new"><button>新增</button></a>
                <table class="score">
                    <thead><td>Name</td><td>View/Modify</td></thead>
                    <% scoresheet %>
                </table>
            </div>
        </section>
    </div>
</body>
</html>