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
        <form action="uploadfile.php" enctype="multipart/form-data" method="post" style="width:272px; margin:50px auto;">
            <input id="file[]" name="file[]" type="file" multiple style="margin:0 auto; width:272px;" /></br>
            <p>允許觀看及下載的班級</p>
            <select multiple class="form-control" id="view_permission[]" name="view_permission[]">
                <% data %>
            </select>
            <input id="submit" name="submit" type="submit" class="btn btn-default" value="上傳" />
        </form>
        </section>
    </div>
</body>
</html>