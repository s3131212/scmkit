<html>
    <head>
    <title>修改請假資料 - <% schoolname %> </title>
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/ajax_load.js"></script>
    <script src="../javascripts/basic.js"></script>
    <script>
    $(document).ready(function(){
        function getQueryString(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return unescape(r[2]); return null;
        }
        if(getQueryString("mode") != null){
            $("#new_box").css("display","none");
            $("#data").css("display","none");
        }else{
            $("#modify_box").css("display","none");
        }
        $("#submit").on("click",function(){
            event.preventDefault();
            $(".loading").show();
            $.ajax({
                url: "ajax/student-modify-incentive.php?mode=new",
                type: "POST",
                data: {
                    type: $("#type").val(),
                    notes: $("#notes").val(),
                    date: $("#date").val(),
                    studentid: '<% id %>'
                },
                dataType:"json",
                success: function(data){
                    $(".alertcon").html(data[0].content);
                    $(".loading").hide();
                    $(".alert").fadeIn(500).delay(2000).fadeOut(500);
                }
            });
        });
        $("#submit2").on("click",function(){
            event.preventDefault();
            $(".loading").show();
            $.ajax({
                url: "ajax/student-modify-incentive.php?mode=modify",
                type: "POST",
                data: {
                    type: $("#type2").val(),
                    notes: $("#notes2").val(),
                    date: $("#date2").val(),
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
        <h1 class="title">用戶資料</h1>
        
        <div class="box" id="data">
        	<table><% data %></table>
        </div>
        <div class="box" id="new_box">
        	<h2>新增功過資料</h2>
        	<div class="alertcon" style="height:60px;"></div>
        	<form>
        		<input type="text" class="form-control" id="type" name="type" placeholder="功過種類"><br />
        		<input type="text" class="form-control" id="date" name="date" placeholder="日期" value="<% date %>"><br />
        		<textarea name="notes" id="notes">註記</textarea><br />
        		<input type="submit" id="submit" value="送出" />
        	</form>
        </div>
        <div class="box" id="modify_box">
            <h2>修改功過資料</h2>
            <div class="alertcon" style="height:60px;"></div>
            <form>
                <input type="text" class="form-control" id="type2" name="type2" placeholder="功過種類" value="<% type %>"><br />
                <input type="text" class="form-control" id="date2" name="date2" placeholder="日期" value="<% date %>"><br />
                <textarea name="notes2" id="notes2"><% notes %></textarea><br />
                <input type="submit" id="submit2" value="送出" />
            </form>
        </div>
        </section>
    </div>
</body>
</html>