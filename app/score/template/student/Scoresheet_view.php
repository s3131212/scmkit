<html>
    <head>
    <title>成績單 - <% schoolname %> </title>
    <% header %>
    <script>
    $(document).ready(function(){ 
        var total = [];
        $(".sort").each(function(){
            total.push(parseFloat($(this).attr("data-score")));
        }); 
        total.sort(function(a, b){ return b-a });
        console.log(total);
        for(var i=0; i < total.length; i++){
            $('[data-score='+total[i]+']').text(i+1);

            //同分例外處理
            if($('[data-score='+total[i]+']').length != 1){
                i += $('[data-score='+total[i]+']').length-1;
            }
        }
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
            <h1 class="title">成績單： <% name %></h1>
            <div class="box"><table><% data %></table></div>

        </section>
    </div>
</body>
</html>