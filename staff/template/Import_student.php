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
    <% nav | student %>
    <section class="content">
        <h1 class="title">匯入學生</h1>
        <form action="import_student.php" enctype="multipart/form-data" method="post" style="width:272px; margin:50px auto;">
            <input id="file" name="file" type="file" style="margin:0 auto; width:272px;"></br>
            <input id="submit" name="submit" type="submit" class="btn btn-default" value="匯入學生">
        </form>
        <p><a href="../file/student_import.xls" class="btn btn-link link">範例檔案下載</a></p>
    </section>
    </div>
</body>
</html>