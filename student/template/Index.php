<html>
<head>
    <title>神秘測試學校</title>
    <link rel="stylesheet" href="../stylesheets/style.css">
    <script src="../javascripts/jquery.min.js"></script>
    <script src="../javascripts/ajax_load.js"></script>
    <script src="../javascripts/basic.js"></script>
    <link rel='stylesheet' href='../css/datepicker.css'>
    <script src='../javascripts/jquery-ui.min.js'></script>
    <script src='../javascripts/bootstrap.min.js'></script>
    <script src='../javascripts/bootstrap-datepicker.js'></script>
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
	   <% nav | index %>   
	 		<section class="content">
			<h1 class="title">學生區</h1>
            <div class="breadcrumb">
                    <i class="fa fa-home"></i> Home
            </div>
			<div class="row">
				<div class="col-md-4">
					<h2>學生區</h2>
					<div class="announcement">
						<p>歡迎來到<% schoolname %>管理系統學生專區，您可以在此快速查閱聯絡簿，下載老師分享的檔案，上傳作業，以及查詢成績。</p>
					</div>
				</div>
  				<div class="col-md-8"><div class="announcement"><?php echo infoget("announcement"); ?></div></div> 				
			</div>
		</section>
    </div>
</body>
</html>