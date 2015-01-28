<html>
    <head>
    <title>編輯檔案 - <% schoolname %> </title>
    <% header %>
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
        <div class="teacher_share">
            <% alert %>
            <a href="?id=<% id %>&method=delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>刪除檔案</a>
            <form class="form-horizontal" role="form" style="margin-top:30px;" method="post" action="?id=<% id %>">
                <div class="form-group">
                    <label for="filename" class="col-sm-2 control-label">檔案名稱</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="filename" name="filename" placeholder="檔案名稱" value="<% filename %>">
                </div>
                </div>
                <div class="form-group">
                    <label for="view_permission[]" class="col-sm-2 control-label">檢視權限</label>
                <div class="col-sm-10">
                    <select multiple class="form-control" id="view_permission[]" name="view_permission[]">
                    <% option %>
                    </select>
                </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-default" value="送出" />
                    </div>
                </div>
            </form>
        </div>
    </section>
    </div>
</body>
</html>