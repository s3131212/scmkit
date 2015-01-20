<html>
    <head>
    <title>留言板 - <% schoolname %> </title>
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
    <% nav | board %>
        <section class="content">
            <h1 class="title">留言板</h1>
            <div class="box"><% data %></div>

        </section>
    </div>
</body>
</html>