<html>
<head>
    <title>作業檔案繳交 - <% schoolname %> </title>
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
        <% nav | homework %>
        <section class="content">
            <h1 class="title">作業檔案繳交</h1>
            <div class="breadcrumb">
                    <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Homework
            </div>
            <table class="share_table">
                <tr>
                    <td>檔案名稱</td>
                    <td>檔案大小</td>
                    <td>下載連結</td>
                    <td>作業名稱</td>
                    <td>上傳結果</td>
                </tr>
                <% data %>
            </table>
        </section>
    </div>
</body>
</html>