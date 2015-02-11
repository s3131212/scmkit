<html>
<head>
    <title>班級管理 - <% schoolname %></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/basic.js"></script>
    <script src="../javascripts/ajax_load.js"></script>
    <script>
    $(document).ready(function(){ 
        $("#submit").on("click",function(){
            event.preventDefault();
            $(".loading").show();
            $.ajax({
                url: "ajax/class-new-cross.php",
                type: "POST",
                data: {
                    class_grade: $("#class_grade").val(),
                    class_name: $("#class_name").val(),
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
    <% nav | class %>
    <section class="content">
        <h1 class="title">班級管理</h1>
        <h2>交叉新增班級</h2>
        <div class="alertcon" style="height:60px;"></div>
       	<form action="" method="post" class="form-horizontal">
        <div class="form-group">
          	<label for="class_grade" class="col-sm-2 control-label">年級</label>
        	<div class="col-sm-10">
            	<input type="text" class="form-control" id="class_grade" name="class_grade" placeholder="年級">
        	</div>
        </div>
        <div class="form-group">
            <label for="class_name" class="col-sm-2 control-label">班級</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="class_name" name="class_name" placeholder="班級">
            </div>
        </div>
        <input type="submit" value="送出" class="btn btn-primary" id="submit" />
        <img src="../fonts/loading.gif" style="display:none; margin-left:10px;" class="loading" />
       	</form>
        <p>交叉新增班級是依照年級與班級作交叉新增，例如當年級為「一,二,三」，班級為「甲,乙」，則會新增「一年甲班」、「一年乙班」、「二年甲班」、「二年乙班」、「三年甲班」、「三年乙班」，請使用半形逗號 ( , ) 作為分隔</p>
    </section>
    </div>
</body>
</html>