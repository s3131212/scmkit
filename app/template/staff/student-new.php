<html>
<head>
    <title>學生資料管理 - <% schoolname %></title>
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
        <h1 class="title">學生資料管理</h1>
        <h2 style="margin-top:30px;">新增學生<a href="student-import.php" class="btn btn-info" style="float:right;">Excel檔匯入</a></h2>
        <form class="form" action="new_student.php" method="post">
            學生名稱：<input type="text" class="form-control" name="name" placeholder="學生名稱"></br>
            學生編號：<input type="text" class="form-control" name="id" placeholder="學生編號"></br>
            登入帳號：<input type="text" class="form-control" name="login_name" placeholder="登入帳號"></br>
            入學學年度：<input type="text" class="form-control" name="academic_year" placeholder="入學學年"></br>
            Email：<input type="text" class="form-control" name="email" placeholder="電子郵件"></br>
            密碼：<input type="text" class="form-control" name="psd" placeholder="密碼"></br>
            班級：<input type="text" class="form-control" name="class_grade" placeholder="年級" style="width:10%; display:inline;"> 年 <input type="text" class="form-control" id="class_name" name="class_name" placeholder="班級名稱" style="width:10%; display:inline;"> 班</br>        
            <hr />
            <input type="submit" class="btn btn-default" value="送出" />
        </form>
    </section>
    </div>
</body>
</html>