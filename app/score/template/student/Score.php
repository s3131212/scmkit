<html>
<head>
    <title>成績查詢 - <% schoolname %> </title>
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
        <% nav | score %>   

        <section class="content">
            <h1 class="title">Score List</h1>
            <div class="breadcrumb">
                    <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Score List
            </div>
            <div class="box box-6">
                <table class="table table-striped">
                    <thead><td>Name</td><td>Score</td><td>Avarage</td></thead>
                    <% score %>
                </table>
            </div>
            <div class="box box-6">
                <table class="table table-striped">
                    <thead><td>Name</td><td>View</td></thead>
                    <% scoresheet %>
                </table>
            </div>
        </section>
    </div>
</body>
</html>
