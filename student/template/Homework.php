<html>
<head>
    <title>作業 - <% schoolname %> </title>
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
        <% nav | homework %>
        <section class="content">
            <h1 class="title">作業檔案繳交</h1>
            <div class="breadcrumb">
                    <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Homework
            </div>
            <div class="box">
                <table class="share_table">
                    <thead><td>作業名稱</td><td>開始時間</td><td>截止時間</td><td>更多</td></thead>
                    <% data %>
                </table>
            </div>
        </section>    
    </div>
</body>
</html>