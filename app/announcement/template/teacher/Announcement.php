<html>
    <head>
    <title>學校公告 - <% schoolname %> </title>
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
        <% nav | announcement %>
        <section class="content">
            <h1 class="title">學校公告</h1>
            <div class="breadcrumb">
                    <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Announcement
            </div>
            <div class="announcement">
                <% data %>
            </div>
        </section>
    </div>
</body>
</html>