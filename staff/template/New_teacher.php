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
        <h1 class="text-center">教師資料管理</h1>
        <div class="box">
        <h2 style="margin-top:30px;">新增教師<a href="import_teacher.php" class="btn btn-info" style="float:right;">Excel檔匯入</a></h2>
        <?php echo $alert; ?>
        <form class="form" action="new_teacher.php" method="post">
            教師名稱：<input type="text" class="form-control" name="name" placeholder="教師名稱"></br>
            教師編號：<input type="text" class="form-control" name="id" placeholder="教師編號"></br>
            登入帳號：<input type="text" class="form-control" name="login_name" placeholder="登入帳號"></br>
            Email：<input type="text" class="form-control" name="email" placeholder="電子郵件"></br>
            密碼：<input type="text" class="form-control" name="psd" placeholder="密碼"></br>
            班級：
                <select multiple class="form-control" id="class[]" name="class[]">
                    <% option %>
                </select>
            <hr />
            <input type="submit" class="btn btn-default" value="送出" />
        </form></div>
    </section>
    </div>
</body>
</html>