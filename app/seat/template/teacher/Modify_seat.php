<html>
    <head>
    <title>更新座位表 - <% schoolname %> </title>
    <% header %>
    <script>
    $(document).ready(function(){ 
        $(".num_input").on("blur",function(){
            if($(this).val()!=""){
                var name_span = $(this).attr("data-name");
                $.ajax({
                    url: "../ajax_get_name/",
                    type: "POST",
                    data: {
                        class: "<% class %>",
                        num: $(this).val()
                    },
                    dataType:"json",
                    success: function(data){
                        $("#"+name_span).text(data[0].content).css("display","none").fadeIn(200);
                    }
                });
            }
        });
        $(".num_input").on("focus",function(){
            var name_span = $(this).attr("data-name");
            $("#"+name_span).fadeOut(200);
        });
        /*
        
        this bug has been fix, but not ready for online.

        $("#height").on( "change",function(){
            $(".modify_seat_table").empty();
            var height = $("#height").val();
            var width = $("#width").val();
            var output = "<table class=\"table seat_table\">";
            for(var i=1;i<=height;i++){
                output+="<tr>";
                for(var j=1;j<=width;j++){
                    output+="<td class=\"num\"><input type=\"text\" class=\"num_input\" data-name=\"name_"+i+"_"+j+"\" name=\"num_"+i+"_"+j+"\" id=\"num_"+i+"_"+j+"\" /></td>";
                }
                output+="</tr><tr>";
                for(var k=1;k<=width;k++){
                    output+="<td class=\"name\"><span id=\"name_"+i+"_"+j+"\"></span></td>";
                }
                output+="</tr>";
            }
            $(".modify_seat_table").html(output);
            console.log(output);
        });
        $("#width").on( "change",function(){
            $(".modify_seat_table").empty();
            var height = $("#height").val();
            var width = $("#width").val();
            var output = "<table class=\"table seat_table\">";
            for(var i=1;i<=height;i++){
                output+="<tr>";
                for(var j=1;j<=width;j++){
                    output+="<td class=\"num\"><input type=\"text\" class=\"num_input\" data-name=\"name_"+i+"_"+j+"\" name=\"num_"+i+"_"+j+"\" id=\"num_"+i+"_"+j+"\" /></td>";
                }
                output+="</tr><tr>";
                for(var k=1;k<=width;k++){
                    output+="<td class=\"name\"><span id=\"name_"+i+"_"+j+"\"></span></td>";
                }
                output+="</tr>";
            }
            $(".modify_seat_table").html(output);
            console.log(output);
        });
        */
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
        <% nav | seat %>
        <section class="content">
            <h1 class="title">座位表</h1>
            <div class="breadcrumb">
                    <i class="fa fa-home"></i> <i class="fa fa-angle-right"></i> Seat
            </div>
            <div class="box">
                <form method="post" action="?id=<% class %>">
                    <% data %>
                    <input type="submit" value="送出" />
                </form>
            </div>
        </section>    
    </div>
</body>
</html>