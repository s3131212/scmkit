<html>
<head>
    <title>新增考試紀錄 - <% schoolname %></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/basic.js"></script>
    <script src="../javascripts/ajax_load.js"></script>
    <script>
    $(document).ready(function(){ 
        $("#new").on("click",function(){
            event.preventDefault();
            $("#score_container").append("<tr class=\"score_form\"><td>姓名  <input type=\"text\"  class=\"name\" placeholder=\"姓名\" name=\"name[]\"></td><td>成績  <input type=\"text\" class=\"score\" placeholder=\"成績\" name=\"score[]\"></td></tr>");
            $(".score_form").fadeIn(500);
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
    <% nav | score %>
    <section class="content">
        <h1 class="title">新增考試紀錄</h1>
        <div class="score" style="margin-top:30px;">
        <form action="score-new.php" method="post" id="form">
            <div class="form-group">
                <label class="col-md-2 control-label">考試名稱</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" class="test_name" placeholder="考試名稱" name="test_name">
                </div>
            </div><br />
            <div class="form-group" style="margin-top:30px; margin-bottom:20px;">
                <select multiple class="form-control" id="view_permission" name="view_permission[]">
                    <% options %>
                </select>
            </div>
            <a href="#" class="btn btn-primary link" id="new"><button>新增一筆資料</button></a>
            <div>
                <table id="score_container">
                    <tr class="score_form">
                        <td>姓名  <input type="text"  class="name" placeholder="姓名" name="name[]"></td>
                        <td>成績  <input type="text" class="score" placeholder="成績" name="score[]"></td>
                    </tr>
                    <tr class="score_form">
                        <td>姓名  <input type="text"  class="name" placeholder="姓名" name="name[]"></td>
                        <td>成績  <input type="text" class="score" placeholder="成績" name="score[]"></td>
                    </tr>
                </table>
        </div>
        <input type="submit" class="btn btn-default" value="送出資料">
    </form>
    </div>
    </section>
    </div>
</body>
</html>