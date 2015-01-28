<html>
    <head>
    <title>編輯考試內容 - <% schoolname %> </title>
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
            <h1 class="title">變更成績</h1>
            <div class="breadcrumb">
                    <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Score
            </div>
            <div class="alertcon" style="height:60px;"></div>
            <h2><% test_name %></h2>
            <div class="score">
            <a href="test_modify.php?id=<% id %>&delete=true"><button>刪除考試紀錄</button></a>
                <form role="form" method="post" action="test_modify.php?id=<% id %>">
                    <div class="form-group">
                        <label for="name">考試名稱</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="考試名稱" value="<% test_name %>">
                    </div>
                    <div class="form-group">
                        <select multiple class="form-control" id="view_permission[]" name="view_permission[]">
                        <% option %>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-default" id="submit" value="修改成績" />
                </form>  
            </div>
        </section>
    </div>
</body>
</html>
