$(document).ready(function() {

    $("#description").change(function(){
        //alert('b');
     });
            var mouseX = 0;
            var mouseY = 0;

            $("#description").mousemove(function(e) {
                // получаем координаты курсора мыши
                mouseX = e.pageX;
                mouseY = e.pageY;
            });
            
            $("#description").mousedown(function() {
                $("#menu").fadeOut("1000");
            });

            $("#description").select(function() {
                // получаем координаты мыши в показанном меню
                $("#menu").css("top", mouseY - 30).css("left", mouseX + 10).fadeIn("1000");
            });

            $("#bold").click(function() {
                wrapText("<b>", "</b>");
                $("#menu").fadeOut("1000");
            });
            
            $("#italic").click(function() {
                wrapText("<i>", "</i>");
                $("#menu").fadeOut("1000");
            });
            
            $("#underline").click(function() {
                wrapText("<u>", "</u>");
                $("#menu").fadeOut("1000");
            });
            $("#h2").click(function() {
                wrapText("<h2>", "</h2>");
                $("#menu").fadeOut("1000");
            });
            $("#h3").click(function() {
                wrapText("<h3>", "</h3>");
                $("#menu").fadeOut("1000");
            });
            $("#right").click(function() {
                wrapText("<p align='right'>", "</p>");
                $("#menu").fadeOut("1000");
            });
            $("#center").click(function() {
                wrapText("<p align='center'>", "</p>");
                $("#menu").fadeOut("1000");
            });
            $("#image").click(function() {
                wrapText("<img src='", "'>");
                $("#menu").fadeOut("1000");
            });
            $("#jg").click(function() {
                
                wrapText("<font color='blue'><b>", "</b></font>");
                $("#menu").fadeOut("1000");
            });
    
            $("#abz").click(function() {
                
                wrapText("<p align='left'>", "</p>");
                $("#menu").fadeOut("1000");
            });
            
            $("#link").click(function() {
                var url = prompt("Введите URL", "http://");
                if (url != null)
                    wrapText("<a href='" + url + "'>", "</a>");
                $("#menu").fadeOut("1000");
            });

            function wrapText(startText, endText){
                // Получаем текст перед выделением
                //alert('1');
                var before = $("#description").val().substring(0, $("#description").caret().start);
                //alert('1');
                
                // Получаем текст после выделения
                var after = $("#description").val().substring($("#description").caret().end, $("#description").val().length);
                
                // Объединяем текст перед выделением, измененное выделение и текст после выделения
                $("#description").val(before + startText + $("#description").caret().text + endText + after);
                
                // Обновляем окно просмотра
                $("#preview").html($("#description").val());
            }
     
           $("#description").keyup(function(){
               value=$("#description").val();
               $("#preview").html(value);
               
           });
            
            $("#description").on('paste', function(){
               value=$("#description").val();
               $("#preview").html(value);
           });

   

            
    });