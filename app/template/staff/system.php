<html>
    <head>
    <title>系統設定 - <% schoolname %> </title>
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
    <% nav | system %>
    <section class="content">
        <h1 class="title">系統設定</h1>
        <% alert %>
        <form action="system.php" method="post" class="form-horizontal" style="margin-top:30px;">
  			<div class="form-group">
    			<label for="schoolname" class="col-sm-2 control-label">學校名稱</label>
    		<div class="col-sm-10">
      			<input type="text" class="form-control" id="schoolname" placeholder="學校名稱" name="schoolname" value="<% schoolname %>">
    		</div>
  			</div>
  			<div class="form-group">
    			<label for="announcement" class="col-sm-2 control-label">公告</label>
    		<div class="col-sm-10">
      			<textarea class="form-control" id="announcement" name="announcement"><% announcement %></textarea>
    		</div>
            </div>
            <div class="form-group">
                <label for="seat_default_width" class="col-sm-2 control-label">座位表預設寬度</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="seat_default_width" placeholder="座位表預設寬度" name="seat_default_width" value="<% seat_default_width %>">
            </div>
            </div>
            <div class="form-group">
                <label for="seat_default_height" class="col-sm-2 control-label">座位表預設長度</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="seat_default_height" placeholder="座位表預設長度" name="seat_default_height" value="<% seat_default_height %>">
            </div>
            </div>
            <div class="form-group">
                <label for="lessons_per_day" class="col-sm-2 control-label">一天課程節數</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="lessons_per_day" placeholder="一天課程節數" name="lessons_per_day" value="<% lessons_per_day %>">
            </div>
            </div>
            <div class="checkbox">
            <label>
                <input type="checkbox" value="true" id="mail" name="mail" <% mail_select %> /> 新增公告時通知全校師生
            </label>
            <span class="help-block">此設定需要 SMTP 伺服器啟動，且此設定可能會增加伺服器負載</span>
            </div>
            <p class="text-center">以下設定只有在 Email 通知功能啟用時需要設定</p>
            <div class="form-group">
              <label for="mail_server" class="col-sm-2 control-label">SMTP 伺服器網址</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mail_server" placeholder="SMTP 伺服器網址" name="mail_server" value="<% mail_server %>">
            </div>
            <span class="help-block">空白時則選用 php.ini 中的設定，使用 Gmail 當作媒介時請填寫 ssl://smtp.gmail.com</span>
            </div>
            <div class="form-group">
              <label for="mail_port" class="col-sm-2 control-label">SMTP 伺服器 Port</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mail_port" placeholder="SMTP 伺服器 Port" name="mail_port" value="<% mail_port %>">
                <span class="help-block">空白時則使用 Port 25 ， SSL 加密請用 587，使用 Gmail 當作媒介時請填寫 465</span>
            </div>
            </div>
            <div class="checkbox">
            <label>
                <input type="checkbox" value="true" id="mail_auth" name="mail_auth" <% mail_auth_select %> /> 啟動 SMTP 驗證模式
            </label>
            <span class="help-block">使用各大電子郵件提供商當作寄信媒介，需要勾選此選項</span>
            </div>
            <div class="form-group">
              <label for="mail_user" class="col-sm-2 control-label">SMTP 帳號</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mail_user" placeholder="SMTP帳號" name="mail_user" value="<% mail_user %>">
                <span class="help-block">僅在啟動 SMTP 驗證時需填寫</span>
            </div>     
            </div>
            <div class="form-group">
              <label for="mail_psd" class="col-sm-2 control-label">SMTP 密碼</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mail_psd" placeholder="SMTP密碼" name="mail_psd" value="<% mail_psd %>">
                <span class="help-block">僅在啟動 SMTP 驗證時需填寫</span>
            </div>
            </div>
      			<div class="form-group">
        			<div class="col-sm-offset-2 col-sm-10">
          			<button type="submit" class="btn btn-default">修改</button>
        			</div>
      			</div>
		</form>
    </section>
    </div>
</body>
</html>