<html>
    <head>
    <title>上傳檔案 - <% schoolname %> </title>
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
        <% nav | teacher_share %>
    <section class="content">
        <h1 class="title">老師的檔案分享</h1>
        <div class="breadcrumb">
            <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> File Share
        </div>
        <table class="share_table" style="margin-top:30px;">
            <tr>
                <td>檔案名稱</td>
                <td>檔案大小</td>
                <td>下載連結</td>
                <td>上傳結果</td>
            </tr>
            <% data %>
        </table>
        <a href="teacher_share.php" class="btn btn-default">回到列表</a>
    </section>
    </div>
</body>
</html>