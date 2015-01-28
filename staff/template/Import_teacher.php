<html>
    <head>
    <title>新增教師資料 - <% schoolname %> </title>
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
        <% nav | teacher_list %>
    <section class="content">
        <h1 class="title">匯入教師</h1>
        <form action="import_teacher.php" enctype="multipart/form-data" method="post" style="width:272px; margin:50px auto;">
            <input id="file" name="file" type="file" style="margin:0 auto; width:272px;"></br>
            <input id="submit" name="submit" type="submit" class="btn btn-default" value="匯入教師">
        </form>
        <p><a href="../file/teacher_import.xls" class="btn btn-link link">範例檔案下載</a></p>
    </section>
    </div>
</body>
</html>