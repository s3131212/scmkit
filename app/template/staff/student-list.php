<html>
    <head>
    <title>學生資料管理 - <% schoolname %> </title>
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
        <% nav | student %>
    <section class="content">
        <h1 class="title">學生資料管理</h1>
        <div class="breadcrumb">
            <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Student
        </div>
        <% title %>
		<% data %>
        </table>
    </section>
    </div>
</body>
</html>