<html>
    <head>
    <title>檔案分享 - <% schoolname %> </title>
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
            <div class="box">
                <a href="upload" class="btn btn-info" style="float:right;display:block;"><button>上傳檔案</button></a>
                <table class="share_table">
                    <thead><td>檔案名稱</td><td>上傳時間</td><td>可下載的班級</td><td>下載檔案</td></thead>
                    <% data %>
                </table>
            </div>
        </section>
    </div>
</body>
</html>