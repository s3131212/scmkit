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
                    firstleveldemerit: $("#firstleveldemerit").val(),
                    secondleveldemerit: $("#secondleveldemerit").val(),
                    warning: $("#warning").val(),
                    firstcredit: $("#firstcredit").val(),
                    secondcredit: $("#secondcredit").val(),
                    reward: $("#reward").val(),
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
        $("#submitb").on("click",function(){
            event.preventDefault();
            $(".loadingb").show();
            $.ajax({
                url: "ajax/new-leave.php",
                type: "POST",
                data: {
                    affairs_num: $("#affairs_num").val(),
                    affairs_date: $("#affairs_date").val(),
                    sick_num: $("#sick_num").val(),
                    sick_date: $("#sick_date").val(),
                    bereavement_num: $("#bereavement_num").val(),
                    bereavement_date: $("#bereavement_date").val(),
                    public_num: $("#public_num").val(),
                    public_date: $("#public_date").val(),
                    truancy_num: $("#truancy_num").val(),
                    truancy_date: $("#truancy_date").val(),
                    id: '<% id %>'
                },
                dataType:"json",
                success: function(data){
                    $(".alertconb").html(data[0].content);
                    $(".loadingb").hide();
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
            <form action="student-modify.php?id=<% id %>" method="post">
                <table class="table table-striped" style="margin-top:30px;">
                    <tr><td>學生名稱</td><td><input type="text" class="form-control" id="name" name="name" placeholder="學生名稱" value="<% name %>"></td></tr>
                    <tr><td>登入帳號</td><td><input type="text" class="form-control" id="login_name" name="login_name" placeholder="登入帳號" value="<% login_name %>"></td></tr>
                    <tr><td>住址</td><td><input type="text" class="form-control" id="address" name="address" placeholder="住址" value="<% address %>"></td></tr>
                    <tr><td>電話</td><td><input type="text" class="form-control" id="phone" name="phone" placeholder="電話" value="<% phone %>"></td></tr>
                    <tr><td>身分證字號</td><td><input type="text" class="form-control" id="personalid" name="personalid" placeholder="身分證字號" value="<% personalid %>"></td></tr>
                    <tr><td>入學學年度</td><td><input type="text" class="form-control" id="academic_year" name="academic_year" placeholder="入學學年" value="<% academic_year %>"></td></tr>
                    <tr><td>Email</td><td><input type="text" class="form-control" id="email" name="email" placeholder="電子郵件" value="<% email %>"></td></tr>
                    <tr><td>班級</td><td><input type="text" class="form-control" id="class_grade" name="class_grade" placeholder="年級" value="<% class_grade %>" style="width:10%; display:inline;"> 年 <input type="text" class="form-control" id="class_name" name="class_name" placeholder="班級名稱" value="<% class_name %>" style="width:10%; display:inline;"> 班</td></tr>
                    <tr><td>獎懲紀錄</td><td>大過：<input type="text" class="form-control" id="firstleveldemerit" name="firstleveldemerit" placeholder="大過" value="<% firstleveldemerit %>" style="width:10%; display:inline;">支&nbsp&nbsp
                        小過：<input type="text" class="form-control" id="secondleveldemerit" name="secondleveldemerit" placeholder="大過" value="<% secondleveldemerit %>" style="width:10%; display:inline;">支&nbsp&nbsp
                        警告：<input type="text" class="form-control" id="warning" name="warning" placeholder="大過" value="<% warning %>" style="width:10%; display:inline;">支</br>
                        大功：<input type="text" class="form-control" id="firstcredit" name="firstcredit" placeholder="大過" value="<% firstcredit %>" style="width:10%; display:inline;">支&nbsp&nbsp
                        小功：<input type="text" class="form-control" id="secondcredit" name="secondcredit" placeholder="大過" value="<% secondcredit %>" style="width:10%; display:inline;">支&nbsp&nbsp
                        嘉獎：<input type="text" class="form-control" id="reward" name="reward" placeholder="大過" value="<% reward %>" style="width:10%; display:inline;">支</td></tr>
                </table>
                <input type="submit" value="送出" class="btn btn-primary" id="submit" />
                <img src="../fonts/loading.gif" style="display:none; margin-left:10px;" class="loading" />
            </form><br />
            <div class="alertconb" style="height:60px;"></div>
            <h3>新增請假</h3>
                <form action="new-leave.php?id=<% id %>&method=leave" method="post">
                    <h4>事假</h4>
                    <div class="form-group">        
                        <label for="affairs_num">節數</label><input type="text" class="form-control" id="affairs_num" name="affairs_num" placeholder="事假節數">
                        <label for="affairs_date">日期</label><input type="text" class="form-control" id="affairs_date" name="affairs_date" placeholder="日期，請使用yyyy/mm/dd，今天是<% date %>">
                    </div>
                    <hr />
                    <h4>病假</h4>
                    <div class="form-group">
                        <label for="sick_num">節數</label><input type="text" class="form-control" id="sick_num" name="sick_num" placeholder="病假節數">
                        <label for="sick_date">日期</label><input type="text" class="form-control" id="sick_date" name="sick_date" placeholder="日期，請使用yyyy/mm/dd，今天是<% date %>">
                    </div>
                    <hr />
                    <h4>喪假</h4>
                    <div class="form-group">
                        <label for="bereavement_num">節數</label><input type="text" class="form-control" name="bereavement_num" id="bereavement_num" placeholder="喪假節數">
                        <label for="bereavement_date">日期</label><input type="text" class="form-control" name="bereavement_date" id="bereavement_date" placeholder="日期，請使用yyyy/mm/dd，今天是<% date %>">
                    </div>
                    <hr />
                    <h4>公假</h4>
                    <div class="form-group">
                        <label for="public_num">節數</label><input type="text" class="form-control" id="public_num" name="public_num" placeholder="公假節數">
                        <label for="public_date">日期</label><input type="text" class="form-control" id="public_date" name="public_date" placeholder="日期，請使用yyyy/mm/dd，今天是<% date %>">
                    </div>
                    <hr />
                    <h4>曠課</h4>
                    <div class="form-group">
                        <label for="truancy_num">節數</label><input type="text" class="form-control" id="truancy_num" name="truancy_num" placeholder="曠課節數">
                        <label for="truancy_date">日期</label><input type="text" class="form-control" id="truancy_date" name="truancy_date" placeholder="日期，請使用yyyy/mm/dd，今天是<% date %>">
                    </div>
                    <input type="submit" value="送出" class="btn btn-primary" id="submitb" />
                    <img src="../fonts/loading.gif" style="display:none; margin-left:10px;" class="loadingb" />
                </form>
        </section>
</div>
</body>
</html>