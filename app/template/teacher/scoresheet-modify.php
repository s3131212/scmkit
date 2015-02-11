<html>
    <head>
    <title>成績單 - <% schoolname %> </title>
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
    <% nav | score %>
        <section class="content">
            <h1>成績單</h1>
            <div class="box">
                <form method="post" action="scoresheet-modify.php?id=<% id %>">
                    成績單名稱： <input type="text" id="name" name="name" placeholder="成績單名稱" value="<% name %>" /> <br />
                    參與班級： <select id="class[]" name="class[]" multiple><% class %></select> <br />
                    考試： <select id="test[]" name="test[]" multiple><% test %></select> <br />
                    <input type="submit" value="送出">
                </form>
            </div>

        </section>
    </div>
</body>
</html>