<html>
<head>
    <title>聯絡簿 - <% schoolname %> </title>
    <% header %>
    <link rel='stylesheet' href='../css/datepicker.css'>
    <script src='../../javascripts/jquery-ui.min.js'></script>
    <script src='../../javascripts/bootstrap.min.js'></script>
    <script src='../../javascripts/bootstrap-datepicker.js'></script>
    <script>
    $(document).ready(function(){ 
         $('.datepickercon').datepicker();
         $('#submit').on('click',function(){
         $('.loading').show();
            $.ajax({
                url: 'load/',
                type: 'POST',
                data: {
                    date: $('#date').val()
                },
                dataType:'json',
                success: function(data){
                    $('.communication').html(data[0].content);
                    $('.loading').hide();
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
    <% nav | communication %>
        <section class="content">
            <h1 class="title">聯絡簿</h1>
            <div class="breadcrumb">
                <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Communication
            </div>
            <div class="form-inline" role="form">
                <input type="text" class="form-control input-lg datepickercon" value="<% date %>" data-date-format="yyyy/mm/dd" id="date" name="date"/>
                <input type="submit" class="btn btn-default" id="submit" value="查詢該日聯絡簿">
        	    <img src="../../fonts/loading.gif" style="display:none; margin-left:10px;" class="loading" />
		    </div>
		    <div class="communication" style="margin-top:30px;">
			<% data %>
		    </div>
        </section>
	</div>
</body>
</html>