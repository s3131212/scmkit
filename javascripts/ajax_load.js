/*
$(document).ready(function(){ 
    $(document.body).css("display","none");
    $(document.body).fadeIn(200);
    $(document).on('click', 'a:not(.link)', function(event){
        event.preventDefault();
        var url= $(this).get(0).href;
        $(document.body).fadeOut(200);
        $.ajax({
            url: url,
            type: 'GET',
            dataType:'html',
            success: function(data){
                var nodes = $.parseHTML(data, null, true);
                window.history.pushState(null, nodes[1].textContent,url);
                var newDoc = document.open("text/html", "replace");
              	newDoc.write(data);
              	newDoc.close();         	
            },
            error: function(){
                alert("此網頁並不存在或有錯誤，請聯絡學校資訊組以取得解決");
                $(document.body).fadeIn(200);
            }
        }); 
    });

 });
 */