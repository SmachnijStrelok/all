 $(document).ready(function() {
    
    $(".do_it").click(function(){
            id=$(this).attr('id'); 
            action=$(this).attr('name');
            title=$("."+id+"[name=title]").val();
            intro_text=$("."+id+"[name=intro_text]").val();
            full_text=$("."+id+"[name=full_text]").val();
            dates=$("."+id+"[name=dates]").val();
            //alert(id+' '+action+' '+title+' '+intro_text+' '+full_text+' '+dates);
            $.post('block.php', {new_id:id, new_action:action, new_title:title, new_intro:intro_text, new_full:full_text, new_dates:dates}, function(data) {
                
            });
        window.location.href = "texpanel.php?c=news";
        });
     
         $(".quest").click(function(){
            id=$(this).attr('id'); 
            action=$(this).attr('name');
            title=$("."+id+"[name=title]").val();
             alert("."+id+"[name=title]");
            question=$("."+id+"[name=question]").val();
            answer=$("."+id+"[name=answer]").val();
            //alert(id+' '+action+' '+title+' '+question+' '+answer);
            $.post('block.php', {quest_id:id, quest_action:action, quest_title:title, quest_question:question, quest_answer:answer}, function(data) {
                
            });
        window.location.href = "texpanel.php?c=faq";
        });
     
             
                  $("body").on('click','.button_remove', function(){
                  //alert('aaa');
                      idButton=$(this).attr('id');
                        //alert(idButton);
                      divId="div_"+idButton;

                      $("."+divId).remove();
                      $("#table_"+idButton).remove();
                      $("#"+idButton).remove();
                });
     
        $("body").on('click','.string_remove', function(){
            idButton=$(this).attr('id');
            
            divId="div_"+idButton;
            divClass=$("#"+divId).attr('class');
            len=$("."+divClass).length;
            //alert(len);
            $("#"+divId).remove();
            tableName=divClass.substr(4);
            if(len<2){
                //alert("#table_"+tableName);
                $("#table_"+tableName).remove();
                $("#"+tableName).remove();
            }
        });
     
     $("body").on('click','.string_add', function(){
         idButton=$(this).attr('id');
         cleanId=idButton.substr(4);
         lastId=$(".div_"+cleanId+":last").attr('id')+"";
         lastCleanId=lastId.substr(4);
         arr=lastCleanId.split('_');
         lastI=parseInt(arr[1],10);
         lastI++;
         $("#td_table").append("<div class='div_"+cleanId+"' id='div_"+cleanId+"_"+lastI+"'><br>Название:<input type='text' name='name_"+cleanId+"_"+lastI+"' class='input_names'><input type='button' value='удалить строку' id='"+cleanId+"_"+lastI+"' class='string_remove  submit_button-simple'><select name='select_"+cleanId+"_"+lastI+"' ><option value='text'>Текст</option><option value='int'>Целое число</option><option value='float'>Число с плавающей точкой</option><option value='string'>Строка(256 символов)</option><option value='file'>Файл</option></select></div>");
         
     });
            $("#tables").change(function() {//добавление таблицы из БД из списка
                var optionID = $('#tables option:selected').attr('id');
                //alert(optionID);
                lastId=0;
                colRows=11;
                value=$('#tables option:selected').val();
                $.post('block.php', {old_table_id:colRows}, function(data){
                        obj=JSON.parse(data);
                        lastId=obj[0];
                    });
                
                
                $.post('block.php', {table_id:optionID}, function(data) {
                    //alert(optionID);
                    $("#"+optionID).attr('disabled', true);
                    lastName=$(".input_names:last").attr('name')+"";
                    names=lastName.split('_');
                    if(names[1]>0){
                        lastId=names[1]+1;
                    }
                    $("#td_table").append("<textarea name='table_"+lastId+"' id='table_"+lastId+"'>"+value+"</textarea><input type='button' class='string_add' id='str_"+lastId+"' value='Добавить строку'>");
                   obj=JSON.parse(data);
                    //$("#strings>option").remove();
                    i=0;
                    for(var keyss in obj){
                        //alert(lastId+"---"+keyss+"---"+obj[keyss]);
                        $("#td_table").append("<div class='div_"+lastId+"' id='div_"+lastId+"_"+i+"'><br>Название:<input type='text' name='name_"+lastId+"_"+i+"' value='"+obj[keyss]+"' class='input_names'><input type='button' value='удалить строку' id='"+lastId+"_"+i+"' class='string_remove  submit_button-simple'><select name='select_"+lastId+"_"+i+"' ><option value='text'>Текст</option><option value='int'>Целое число</option><option value='float'>Число с плавающей точкой</option><option value='string'>Строка(256 символов)</option><option value='file'>Файл</option></select></div>");
                        i++;
                    }//Значение: <textarea name='value_"+lastId+"_"+keyss+"'></textarea>
                    $("#td_table").append("<input type='button' id='"+lastId+"' value='удалить таблицу' class='button_remove submit_button-simple'>");
                    

                });
            });
             
         
                  
                  
                  
                  
                  
            $("#button_add").click(function(){//добавление таблицу добавленной пользователем
                tableName=$("#tables_name").val();
                colRows=$("#col_columns").val();
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
                        $("#td_table").append("<div class='div_"+lastId+"' id='div_"+lastId+"_"+i+"'><label class='label'>Название:<input type='text' name='name_"+lastId+"_"+i+"' class='input_names'></label><input type='button' value='Удалить строку' id='"+lastId+"_"+i+"' class='string_remove submit_button-simple'><select name='select_"+lastId+"_"+i+"'><option value='text'>Текст</option><option value='int'>Целое число</option><option value='float'>Число с плавающей точкой</option><option value='string'>Строка(256 символов)</option><option value='file'>Файл</option></select><br></div>");//Значение: <textarea name='value_"+lastId+"_"+i+"'></textarea>
                    }
                    $("#td_table").append("<input type='button' id='"+lastId+"' value='Удалить таблицу' class='button_remove submit_button-simple'>");
                });
            });
        });
		
