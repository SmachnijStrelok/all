 $(document).ready(function() {
    
    $(".do_it").click(function(){//при клике на кнопку изменить/удалить новость
            //хитрожопым способом получаем значения всех нужных нам полей
            id=$(this).attr('id'); 
            action=$(this).attr('name');//если значение delete удаляем эту запиздь, если update то обновляем
            title=$("."+id+"[name=title]").val();
            intro_text=$("."+id+"[name=intro_text]").val();
            full_text=$("."+id+"[name=full_text]").val();
            dates=$("."+id+"[name=dates]").val();
            //мы отсылаем на сервер все те данные, которые пользователь ввел в поля
            $.post('block.php', {new_id:id, new_action:action, new_title:title, new_intro:intro_text, new_full:full_text, new_dates:dates}, function(data) {
                
            });
        window.location.href = "texpanel.php?c=news";//перезагружаем страницу для обновления инфы
        });
     
         $(".quest").click(function(){//при клике на ккнопку изменить/удалить вопрос в ЧАВО
            id=$(this).attr('id'); 
            action=$(this).attr('name');//если значение delete удаляем эту запиздь, если update то обновляем
            title=$("."+id+"[name=title]").val();
             //alert("."+id+"[name=title]");
            question=$("."+id+"[name=question]").val();
            answer=$("."+id+"[name=answer]").val();
             //alert(title+'---'+question+'---'+answer);
            //мы отсылаем на сервер все те данные, которые пользователь ввел в поля
            $.post('block.php', {quest_id:id, quest_action:action, quest_title:title, quest_question:question, quest_answer:answer}, function(data) {
                
            });
        window.location.href = "texpanel.php?c=faq";
        });
     
             
                  $("body").on('click','.button_remove', function(){//удаление раздела
                  //alert('aaa');
                      idButton=$(this).attr('id');
                        //alert(idButton);
                      divId="div_"+idButton;//получаем ID
                      $(this).next().remove();
                      $(this).next().remove();

                      $("."+divId).remove();
                      $("#table_"+idButton).remove();//удаляем поле с названием таблицы
                      $("#"+idButton).remove();//удаляем саму кнопку
                      $("#str_"+idButton).remove();//поле удаляем
                });
     
        $("body").on('click','.string_remove', function(){//удаление строки из раздела
            idButton=$(this).attr('id');
            
            divId="div_"+idButton;
            divClass=$("#"+divId).attr('class');
            len=$("."+divClass).length;
            //alert(len);
            $("#"+divId).remove();
            tableName=divClass.substr(4);
            if(len<2){//если это последняя строка, то удаляем всю таблицу
                //alert("#table_"+tableName);
                $("#table_"+tableName).remove();
                $("#"+tableName).remove();
                $("#str_"+idButton).remove();
            }
        });
     
     $("body").on('click','.string_add', function(){//добавление строки
         idButton=$(this).attr('id');
         cleanId=idButton.substr(4);
         lastId=$(".div_"+cleanId+":last").attr('id')+"";
         lastCleanId=lastId.substr(4);
         arr=lastCleanId.split('_');
         lastI=parseInt(arr[1],10);
         lastI++;
         $("#td_table").append("<div class='div_"+cleanId+"' id='div_"+cleanId+"_"+lastI+"'><br>Название:<input type='text' name='name_"+cleanId+"_"+lastI+"' class='input_names'><input type='button' value='удалить строку' id='"+cleanId+"_"+lastI+"' class='string_remove'><select name='select_"+cleanId+"_"+lastI+"' align='right'><option value='text'>Текст</option><option value='int'>Целое число</option><option value='float'>Число с плавающей точкой</option><option value='string'>Строка(256 символов)</option></select></div>");
         
     });
            $("#tables").change(function() {//добавление таблицы из БД из списка
                var optionID = $('#tables option:selected').attr('id');
                //alert(optionID);
                lastId=0;
                colRows=11;
                value=$('#tables option:selected').val();
                $.post('block.php', {old_table_id:colRows}, function(data){//мы запрашиваем ID последней таблицы
                        obj=JSON.parse(data);
                        lastId=obj[0];
                    });
                
                
                $.post('block.php', {table_id:optionID}, function(data) {//запрашиваем все данные о разделе
                    //alert(optionID);
                    $("#"+optionID).attr('disabled', true);
                    lastName=$(".input_names:last").attr('name')+"";
                    names=lastName.split('_');
                    if(names[1]>0){
                        lastId=names[1]+1;
                    }
                    $("#td_table").append("<textarea name='table_"+lastId+"' id='table_"+lastId+"'>"+value+"</textarea></td><td><input type='button' class='string_add' id='str_"+lastId+"' value='Добавить строку'>");
                   obj=JSON.parse(data);
                    //$("#strings>option").remove();
                    i=0;
                    for(var keyss in obj){//выводим все поля раздела на экран
                        //alert(lastId+"---"+keyss+"---"+obj[keyss]);
                        $("#td_table").append("<div class='div_"+lastId+"' id='div_"+lastId+"_"+i+"'>Название:<input type='text' name='name_"+lastId+"_"+i+"' value='"+obj[keyss]+"' class='input_names'><input type='button' value='удалить строку' id='"+lastId+"_"+i+"' class='string_remove'><select name='select_"+lastId+"_"+i+"' ><option value='text'>Текст</option><option value='int'>Целое число</option><option value='float'>Число с плавающей точкой</option><option value='string'>Строка(256 символов)</option></select></div>");
                        /*
                        $("#td_table").append("<tr><td><div class='div_"+lastId+"' id='div_"+lastId+"_"+i+"'><br>Название:<input type='text' name='name_"+lastId+"_"+i+"' value='"+obj[keyss]+"' class='input_names'></td><td><input type='button' value='удалить строку' id='"+lastId+"_"+i+"' class='string_remove'></td><td><select name='select_"+lastId+"_"+i+"' ><option value='text'>Текст</option><option value='int'>Целое число</option><option value='float'>Число с плавающей точкой</option><option value='string'>Строка(256 символов)</option></select></div></td></tr>");
                        */
                        i++;
                    }//Значение: <textarea name='value_"+lastId+"_"+keyss+"'></textarea>
                    $("#td_table").append("<input type='button' id='"+lastId+"' value='удалить таблицу' class='button_remove'><br><br>");

                });
            });
             
         
                  
                  
                  
                  
                  
            $("#button_add").click(function(){//добавление таблицу добавленной пользователем
                tableName=$("#tables_name").val();//название
                colRows=$("#col_columns").val();//кол-во полей
                //alert(tableName+"--"+colRows);
                $.post('block.php', {old_table_id:colRows}, function(data){
                    obj=JSON.parse(data);
                    //alert(obj[0]);
                    lastId=obj[0];
                    lastName=$(".input_names:last").attr('name')+"";
                    names=lastName.split('_');
                    if(names[1]>0){
                        lastId=names[1]+1;
                    }
                    $("#td_table").append("<textarea name='table_"+lastId+"' id='table_"+lastId+"'>"+tableName+"</textarea>");
                    for(i=0;i<colRows;i++){
                        $("#td_table").append("<div class='div_"+lastId+"' id='div_"+lastId+"_"+i+"'><br>Название:<input type='text' name='name_"+lastId+"_"+i+"' class='input_names'><input type='button' value='удалить строку' id='"+lastId+"_"+i+"' class='string_remove'><select name='select_"+lastId+"_"+i+"'><option value='text'>Текст</option><option value='int'>Целое число</option><option value='float'>Число с плавающей точкой</option><option value='string'>Строка(256 символов)</option><option value='file'>Файл</option></select><br></div>");//Значение: <textarea name='value_"+lastId+"_"+i+"'></textarea>
                    }
                    $("#td_table").append("<input type='button' id='"+lastId+"' value='удалить таблицу' class='button_remove'><br><br>");
                });
            });
        });