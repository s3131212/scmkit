<html>
<head>
    <title>班級管理 - <% schoolname %></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/basic.js"></script>
    <script src="../javascripts/ajax_load.js"></script>
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
        <div class="box box-6">
            <table class="class_table">
                <thead><td>班級名稱</td><td>管理</td></thead>
            	<% data %>
            </table>
            <a href="class-new.php" class="btn"><button>新增班級</button></a>
            <a href="class-new-cross.php" class="btn"><button>交叉新增班級</button></a>
        </div>
    </section>
    </div>
</body>
</html>