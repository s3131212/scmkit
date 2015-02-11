<html>
<head>
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
    <% nav | score %>
    <section class="content">
        <h1 class="text-center">新增考試紀錄</h1>
        <div class="score">
            <form action="score-import.php" enctype="multipart/form-data" method="post" style="margin-top:30px;">
                <div class="form-group">
                    <label for="name">考試名稱</label>
                    <input type="text" placeholder="考試名稱" name="name" id="name" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="score">考試成績</label>
                    <input id="score" name="score" type="file" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="view_permission[]">參與班級</label>
                    <select multiple class="form-control" id="view_permission[]" name="view_permission[]" >
                        <% options %>
                    </select>
                </div>
                <input id="submit" name="submit" type="submit" class="btn btn-default" value="匯入成績">
            </form>
        <p><a href="../file/score_import.xls" class="btn btn-link link">範例檔案下載</a></p>
        </div>
    </section>
    </div>
</body>
</html>