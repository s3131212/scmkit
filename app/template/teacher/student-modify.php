<html>
    <head>
    <title>編輯學生資料 - <% schoolname %> </title>
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/ajax_load.js"></script>
    <script src="../javascripts/basic.js"></script>
    <script>
    $(document).ready(function(){ 
        $("#submit").on("click",function(){
            event.preventDefault();
            $(".loading").show();
            $.ajax({
                url: "ajax/student-modify.php",
                type: "POST",
                data: {
                    name: $("#name").val(),
                    login_name: $("#login_name").val(),
                    address: $("#address").val(),
                    phone: $("#phone").val(),
                    personalid: $("#personalid").val(),
                    academic_year: $("#academic_year").val(),
                    class_grade: $("#class_grade").val(),
                    class_name: $("#class_name").val(),
                    email: $("#email").val(),
                    id: '<% id %>'
                },
                dataType:"json",
                success: function(data){
                    $(".alertcon").html(data[0].content);
                    $(".loading").hide();
                    $(".alert").fadeIn(500).delay(2000).fadeOut(500);
                }
            });
        });
    });
    </script>
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
            <div class="alertcon" style="height:60px;"></div>
            <form action="student-modify.php?id=<% id %>" method="post" class="box">
                <table class="table table-striped" style="margin-top:30px;">
                    <tr><td>學生名稱</td><td><input type="text" class="form-control" id="name" name="name" placeholder="學生名稱" value="<% name %>"></td></tr>
                    <tr><td>登入帳號</td><td><input type="text" class="form-control" id="login_name" name="login_name" placeholder="登入帳號" value="<% login_name %>"></td></tr>
                    <tr><td>住址</td><td><input type="text" class="form-control" id="address" name="address" placeholder="住址" value="<% address %>"></td></tr>
                    <tr><td>電話</td><td><input type="text" class="form-control" id="phone" name="phone" placeholder="電話" value="<% phone %>"></td></tr>
                    <tr><td>身分證字號</td><td><input type="text" class="form-control" id="personalid" name="personalid" placeholder="身分證字號" value="<% personalid %>"></td></tr>
                    <tr><td>入學學年度</td><td><input type="text" class="form-control" id="academic_year" name="academic_year" placeholder="入學學年" value="<% academic_year %>"></td></tr>
                    <tr><td>Email</td><td><input type="text" class="form-control" id="email" name="email" placeholder="電子郵件" value="<% email %>"></td></tr>
                    <tr><td>班級</td><td><input type="text" class="form-control" id="class_grade" name="class_grade" placeholder="年級" value="<% class_grade %>" style="width:10%; display:inline;"> 年 <input type="text" class="form-control" id="class_name" name="class_name" placeholder="班級名稱" value="<% class_name %>" style="width:10%; display:inline;"> 班</td></tr>
                </table>
                <input type="submit" value="送出" class="btn btn-primary" id="submit" />
                <img src="../fonts/loading.gif" style="display:none; margin-left:10px;" class="loading" />
            </form><br />
            <div class="box">
                <a href="student-modify-leave.php?id=<% id %>"><button>修改請假紀錄</button></a>
                <a href="student-modify-incentive.php?id=<% id %>"><button>修改功過紀錄</button></a>
            </div>
        </section>
</div>
</body>
</html>