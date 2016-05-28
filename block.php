<?php
    header('Content-Type: text/html; charset=utf-8');
    $db = mysql_connect("localhost", "root", "slipknot");
    mysql_select_db("good_mark");
    
    if(isset($_POST['new_id']) AND isset($_POST['new_title']) AND isset($_POST['new_intro']) AND isset($_POST['new_full']) AND isset($_POST['new_dates']) ){//обновление новостей, проверка на заполнение
        $action=str_replace('\n','',htmlspecialchars(mysql_real_escape_string($_POST['new_action'])));
        $new_id=str_replace('\n','',htmlspecialchars(mysql_real_escape_string($_POST['new_id'])));
        $new_title=str_replace('\n','',htmlspecialchars(mysql_real_escape_string($_POST['new_title'])));
        $new_intro=str_replace('\n','',mysql_real_escape_string($_POST['new_intro']));
        $new_full=str_replace('\n','',mysql_real_escape_string($_POST['new_full']));
        $new_dates=str_replace('\n','',htmlspecialchars(mysql_real_escape_string($_POST['new_dates'])));
        if($action=='update'){
            mysql_query("UPDATE news SET title='$new_title', intro_text='$new_intro', full_text='$new_full', dates='$new_dates' WHERE new_id='$new_id'");
        }elseif($action=='remove'){
            mysql_query("DELETE FROM news WHERE new_id='$new_id'");
        }
    }

    if(isset($_POST['quest_id']) AND isset($_POST['quest_question']) AND isset($_POST['quest_answer']) ){//обновление ЧАВО проверка на заполнение
        $action=str_replace('\n','',htmlspecialchars(mysql_real_escape_string($_POST['quest_action'])));
        $quest_id=str_replace('\n','',htmlspecialchars(mysql_real_escape_string($_POST['quest_id'])));
        $quest_question=str_replace('\n','',htmlspecialchars(mysql_real_escape_string($_POST['quest_question'])));
        $quest_answer=str_replace('\n','',htmlspecialchars(mysql_real_escape_string($_POST['quest_answer'])));
        $quest_title=str_replace('\n','',mysql_real_escape_string($_POST['quest_title']));
        if($action=='update'){
            mysql_query("UPDATE faq SET title='$quest_title', question='$quest_question', answer='$quest_answer' WHERE id='$quest_id'");
        }elseif($action=='remove'){
            mysql_query("DELETE FROM faq WHERE id='$quest_id'");
        }
    }
 
    if(isset($_POST['id'])) {//все данные об организации по ее ID
        //$_POST['id'] = 1;
    
    $value=$_POST['id'];
    $s_value=mysql_query("SELECT name, inn, kpp, ogrn, okpo, okato, oved, ur_adress, f_adress, kor_adress, fax, phone, email  FROM organizations WHERE name='".$value."'");
    $res_val=mysql_fetch_assoc($s_value);
    echo json_encode($res_val); 
    }
    
    if(isset($_POST['table_id'])){//вытаскиваем раздел(таблицу из БД)
        $tableId=$_POST['table_id'];
        //$tableId=mysql_result(mysql_query("SELECT id FROM tables WHERE name='$tableName'"),0);
        $sStringId=mysql_query("SELECT string_id FROM table_id WHERE table_id='$tableId'");
        $col=mysql_num_rows($sStringId);
        $arr=array();
        for($i=0;$i<$col;$i++){
            $stringId=mysql_result($sStringId,$i);
            $stringName=mysql_result(mysql_query("SELECT name FROM string WHERE id='$stringId'"),0);
            $arr[$stringId]=$stringName;
            //print $arr[$stringId];
        }
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    }
if(isset($_POST['old_table_id'])){//получаем ID последней таблицы
    $arr[0]=mysql_result(mysql_query("SELECT max(id) FROM tables"),0)+1;
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
}
?>