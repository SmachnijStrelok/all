<?php
header('Content-Type: text/html; charset=utf-8');
$db = mysql_connect("localhost", "root", "slipknot");
mysql_select_db("good_mark");
error_reporting (0);?>

<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="images/icon.jpg">
<title>Краевой фонд науки - Регистрация</title>
<script type="text/javascript" src="jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="wrapper">
	<header>
		<div id="hed_main">
			<a href="http://krai-fond.ru"><span id="hed_title">Краевой фонд науки</span></a>
		</div>
		<span id="post_header">ДУМАЕМ ГЛОБАЛЬНО</span>
	</header>

	<nav>
		<div class="main_menu">
			<a href="application.php" class="main_menu_buttons">Подать заявку</a>
			<a href="redactor.php" class="main_menu_buttons">Реестр заявок</a>
			<a href="redactor.php?a=newapp" class="main_menu_buttons">Добавление конкурса</a>
			<a href="#" class="main_menu_buttons">Помощь</a>
		</div>
	</nav>


<div id="content" class="clearfix">
	<div class="content_2">
		<aside>
			<div id="aside_buttons_all" class="clearfix">
			
				<div id="aside_button_1" class="clearfix">
					<a href="#" id="aside_button_1c" class="aside_buttons"><span>Пусто</span></a>
				</div>
				
				<div id="aside_button_2" class="clearfix">
					<a href="#" id="aside_button_2c" class="aside_buttons"><span>Пусто</span></a>
				</div>
				
				<div id="aside_button_3" class="clearfix">
					<a href="#" id="aside_button_3c" class="aside_buttons"><span>Пусто</span></a>
				</div>
				
				<div id="aside_button_4" class="clearfix">
					<a href="#" id="aside_button_4c" class="aside_buttons"><span>Пусто</span></a>
				</div>
				
				<div id="aside_button_5" class="clearfix">
					<a href="#" id="aside_button_5c" class="aside_buttons"><span>Пусто</span></a>
				</div>
				
				<div id="aside_button_6" class="clearfix">
					<a href="#" id="aside_button_6c" class="aside_buttons"><span>Пусто</span></a>
				</div>
				
			</div>
			
		</aside>

		<div class="content_box_1">
			
			<div class="inline_contet_box_1">

<?php
function printUserInformation($userId){
        $sInformation=mysql_query("SELECT * FROM users WHERE user_id='$userId'");
        $arrInformation=mysql_fetch_assoc($sInformation);
        $jobId=$arrInformation['job'];
        $job=mysql_result(mysql_query("SELECT job FROM job WHERE job_id='$jobId'"),0);
        if($arrInformation['gender']=='male'){
            $sex='Мужской';
        }else{
            $sex='Женский';
        }
        print "<p class='opis'>фамилия:</p>"
            .$arrInformation['surname'].
            "<p class='opis'>Имя:</p>"
            .$arrInformation['name'].
            "<p class='opis'>Отчество:</p>"
            .$arrInformation['middle_name'].
            "<p class='opis'>Дата Рождения:</p>"
            .$arrInformation['date_birth'].
            "<p class='opis'>Пол:</p>"
            .$sex.
            "<p class='opis'>Домашний адрес:</p>"
            .$arrInformation['adress'].
            "<p class='opis'>Домашний индекс:</p>"
            .$arrInformation['p_index'].
            "<p class='opis'>Подразделение:</p>"
            .$arrInformation['podrazd'].
            "<p class='opis'>Должность:</p>"
            .$job.
            "<p class='opis'>Электронный адрес:</p>"
            .$arrInformation['email'].
            "<p class='opis'>Контактный телефон:</p>"
            .$arrInformation['phone'].
            "<p class='opis'>Дата регистрации:</p>"
            .$arrInformation['dates'];
    }
    
    function printOrgInformation($orgId){
        $sInformation=mysql_query("SELECT * FROM organizations WHERE id_org='$orgId'");
        $arrInformation=mysql_fetch_assoc($sInformation);
        
        print "<p class='opis'>Название организации:</p>"
            .$arrInformation['name'].
            "<p class='opis'>ИНН:</p>"
            .$arrInformation['inn'].
            "<p class='opis'>КПП:</p>"
            .$arrInformation['kpp'].
            "<p class='opis'>ОГРН:</p>"
            .$arrInformation['ogrn'].
            "<p class='opis'>ОКПО:</p>"
            .$arrInformation['okpo'].
            "<p class='opis'>ОКАТО:</p>"
            .$arrInformation['okato'].
            "<p class='opis'>Основной вид экономической деятельности:</p>"
            .$arrInformation['oved'].
            "<p class='opis'>Юридический адрес:</p>"
            .$arrInformation['ur_adress'].
            "<p class='opis'>Фактический адрес:</p>"
            .$arrInformation['f_adress'].
            "<p class='opis'>Адрес для корреспонденции:</p>"
            .$arrInformation['kor_adress'].
            "<p class='opis'>Факс:</p>"
            .$arrInformation['fax'].
            "<p class='opis'>Телефон:</p>"
            .$arrInformation['phone'].
            "<p class='opis'>Электронный адрес:</p>"
            .$arrInformation['email'];
        
    }








if(@$_GET['id']=='' && @$_GET['user']=='' && @$_GET['a']==''){
    $sAllApplication=mysql_query("SELECT * FROM applications");
    
    $colApplications=mysql_num_rows($sAllApplication);
    print "<table border=1 style=''><tr>
    <td><span class='title'>Номер</span></td>
    <td><span class='title'>Название Конкурса</span></td>
    <td><span class='title'>Дата начала</span></td>
    <td><span class='title'>Дата окончания</span></td></tr>";
    for($i=0;$i<$colApplications;$i++){
        $arrayApplications=mysql_fetch_assoc($sAllApplication);
        print "<tr><td><span class='info_table'>".$arrayApplications['id']."</span></td>
            <td><a href='redactor.php?id=".$arrayApplications['id']."' class='con_a'>".$arrayApplications['name']."</a></td>
            <td><span class='info_table'>".$arrayApplications['date_begin']."</span></td>
            <td><span class='info_table'>".$arrayApplications['date_end']."</span></td></tr>";
    }    
    print "</table>";
}elseif($_GET['id']!='' && $_GET['user']=='' && $_GET['a']==''){
    $checkId=htmlspecialchars(mysql_real_escape_string($_GET['id']));
    $delId=htmlspecialchars(mysql_real_escape_string($_GET['del_id']));
    if($_GET['del_id']!=''){
        
        $userId=mysql_result(mysql_query("SELECT user_id FROM accepted WHERE con_id='$delId'"),0);
        $sAllApplication=mysql_query("SELECT table_id FROM app_id WHERE app_id='$delId'");
        //mysql_query("DELETE FROM applications WHERE id='$delId'");
        //mysql_query("DELETE FROM accepted WHERE con_id='$delId'");
        //mysql_query("DELETE FROM request WHERE app_id='$delId'");
        $colTables=mysql_num_rows($sAllApplication);
        for($i=0;$i<$colTables;$i++){
            $tableId=mysql_result($sAllApplication,$i);
            $colAppTables=mysql_num_rows(mysql_query("SELECT id FROM app_id WHERE table_id='$tableId'"));
            if($colAppTables < 2){
                $stringId=mysql_query("SELECT string_id FROM table_id WHERE table_id='$tableId'");
                $colString=mysql_num_rows($stringId);
                for($j=0;$j<$colString;$j++){
                    $resStringId=mysql_result($stringId,$j);
                    print "<script>alert('".mysql_num_rows(mysql_query("SELECT id FROM table_id WHERE string_id='$resStringId'"))."');</script>";
                    if(mysql_num_rows(mysql_query("SELECT id FROM table_id WHERE string_id='$resStringId'")) < 2){
                        mysql_query("DELETE FROM table_id WHERE string_id='$resStringId'");
                        mysql_query("DELETE FROM string WHERE id='$resStringId'");
                    }
                }
                mysql_query("DELETE FROM app_id WHERE table_id='$tableId'");
                mysql_query("DELETE FROM tables WHERE id='$tableId'");
            }
        }
        mysql_query("DELETE FROM applications WHERE id='$delId'");
        mysql_query("DELETE FROM accepted WHERE con_id='$delId'");
        mysql_query("DELETE FROM request WHERE app_id='$delId'");
    }
    
    
     print "<form action='redactor.php?id=".$checkId."' method='POST' id='form_selection'>
<input type='radio' name='selection' value='all' id='all'/> 
<label for='all'>Все</label>
<input type='radio' name='selection' value='y' id='y'/> 
<label for='y'>Принятые</label>
<input type='radio' name='selection' value='n' id='n'/>
<label for='n'>Не принятые</label>
 <button type='submit' value='Фильтровать' id='form_submit'>Фильтровать</button></form>
     <table border=1><tr>
    <td><span class='title'>Просмотр</span></td>
    <td><span class='title'>Пользователь</span></td>
    <td><span class='title'>Организация</span></td>
    <td><span class='title'>Дата подачи</span></td>
    <td><span class='title'>Состояние</span></td>
    <td><span class='title'><a href='redactor.php?id=".$checkId."&del_id=".$checkId."'>удалить</a></span></td></tr>";
    
    if(@$_POST['selection']=='' || @$_POST['selection']=='all'){
        $sApp=mysql_query("SELECT * FROM accepted WHERE con_id='$checkId'");
        $colApp=mysql_num_rows(mysql_query("SELECT id FROM accepted WHERE con_id='$checkId'"));
        //$arrApp=mysql_fetch_assoc($sApp);
        for($i=0;$i<$colApp;$i++){
            $arrApp=mysql_fetch_assoc($sApp);
            $aOrg=$arrApp['org_id'];
            $org=mysql_result(mysql_query("SELECT name FROM organizations WHERE id_org='$aOrg'"),0);
            print "<tr><td><a href='redactor.php?id=".$checkId."&user=".$arrApp['user_id']."' class='con_a'>просмотр</a></td>
                <td><span class='info_table'>".$arrApp['user_id']."</span></td>
                <td><span class='info_table'>".$org."</span></td>
                <td><span class='info_table'>".$arrApp['dates']."</span></td>
                <td><span class='info_table'>".$arrApp['accepted']."</span></td>
                <td><span class='info_table'><a href='redactor.php?id=".$checkId."&del_id=".$checkId."'>удалить</a></span></td></tr>";
        }
    }elseif($_POST['selection']=='y'){
        $sApp=mysql_query("SELECT * FROM accepted WHERE con_id='$checkId' AND accepted='y'");
        $colApp=mysql_num_rows(mysql_query("SELECT id FROM accepted WHERE con_id='$checkId' AND accepted='y'"));
        //$arrApp=mysql_fetch_assoc($sApp);
        for($i=0;$i<$colApp;$i++){
            $arrApp=mysql_fetch_assoc($sApp);
            $aOrg=$arrApp['org_id'];
            $org=mysql_result(mysql_query("SELECT name FROM organizations WHERE id_org='$aOrg'"),0);
            print "<tr><td><a href='redactor.php?id=".$checkId."&user=".$arrApp['user_id']."'>просмотр</a></td>
                <td><span class='info_table'>".$arrApp['user_id']."</span></td>
                <td><span class='info_table'>".$org."</span></td>
                <td><span class='info_table'>".$arrApp['dates']."</span></td>
                <td><span class='info_table'>".$arrApp['accepted']."</span></td></tr>";
        }
    }elseif($_POST['selection']=='n'){
        $sApp=mysql_query("SELECT * FROM accepted WHERE con_id='$checkId' AND accepted='n'");
        $colApp=mysql_num_rows(mysql_query("SELECT id FROM accepted WHERE con_id='$checkId' AND accepted='n'"));
        //$arrApp=mysql_fetch_assoc($sApp);
        for($i=0;$i<$colApp;$i++){
            $arrApp=mysql_fetch_assoc($sApp);
            $aOrg=$arrApp['org_id'];
            $org=mysql_result(mysql_query("SELECT name FROM organizations WHERE id_org='$aOrg'"),0);
            print "<tr><td><a href='redactor.php?id=".$checkId."&user=".$arrApp['user_id']."'>просмотр</a></td>
                <td><span class='info_table'>".$arrApp['user_id']."</span></td>
                <td><span class='info_table'>".$org."</span></td>
                <td><span class='info_table'>".$arrApp['dates']."</span></td>
                <td><span class='info_table'>".$arrApp['accepted']."</span></td></tr>";
        }
    }
}elseif(@$_GET['id']!='' && @$_GET['user']!='' && @$_GET['a']==''){
    $checkId=htmlspecialchars(mysql_real_escape_string($_GET['id']));
    $checkUser=htmlspecialchars(mysql_real_escape_string($_GET['user']));
    //print_r($_POST);
    $array=array();
    $val='';
    foreach($_POST as $key=>$value) {
        //$key = $value;
        //$val=htmlspecialchars(mysql_real_escape_string($_POST[$key]));
        if($key=='accept' && $value=='yes'){
            mysql_query("UPDATE accepted SET accepted='y' WHERE con_id='$checkId' AND user_id='$checkUser'");
        }
        $x=mysql_real_escape_string(htmlspecialchars($value));
        //print "<script>alert('".$key."');</script>";
        //print "+++".$key."---".$x;
        mysql_query("UPDATE request SET value='$x' WHERE string_id='$key'");
    }
    $orgId=mysql_result(mysql_query("SELECT org_id FROM accepted WHERE user_id='$checkUser' AND con_id='$checkId'"),0);
    //print "<script>alert('".$orgId."---".$checkId."---".$checkUser."');</script>";
    print "<table style='border:0px;'><tr><td>";
    printUserInformation($checkUser);
    print "</td><td>";
    printOrgInformation($orgId);
    print "</td></tr><tr><td>";
    
    $sTables=mysql_query("SELECT table_id FROM app_id WHERE app_id='$checkId'");//получаем Н записей с номерами таблиц которые есть в данном конкурсе
    $colTables=mysql_num_rows($sTables);
    print "<form action='redactor.php?id=".$checkId."&user=".$checkUser."' method='POST'>";
    for( $i = 0; $i < $colTables; $i ++ ){
        
        $idTable=mysql_result($sTables,$i);
        $nameTable=mysql_result(mysql_query("SELECT name FROM tables WHERE id='$idTable'"),0);
        $sStringId=mysql_query("SELECT string_id FROM table_id WHERE table_id='$idTable'");
        $colString=mysql_num_rows($sStringId);
        print "<p class='table_name'>".$nameTable."</p>";
        
        for( $j = 0 ; $j < $colString ; $j ++ ){
            
            $idString=mysql_result($sStringId,$j);//идентификатор строки
            $id=mysql_result(mysql_query("SELECT id FROM request WHERE table_id='$idTable' AND string_id='$idString' AND user_id='$checkUser'"),0);
            $nameString=mysql_result(mysql_query("SELECT name FROM string WHERE id='$idString'"),0);//получаем название строки
            $userValue=mysql_result(mysql_query("SELECT value FROM request WHERE string_id='$idString' AND user_id='$checkUser'"),0);//получаем значение введенное пользователем
            print "<p class='opis'>".$nameString.":</p><br><textarea name='".$idString."' cols=40 rows=4>".$userValue."</textarea><br>";
        }
    }
    print "<input type='checkbox' name='accept' value='yes'> Принять заявку<br><input type='submit' id='form_submit' style='margin-left:-130px;'></form></td></tr></table>";
    
    

}elseif($_GET['a']=='newapp'){
    if(isset($_POST['name'])){
        //print $_POST['name'];
         //foreach($_POST as $key=>$value){
          //   print $key."---".$value."<br>";
         //}
        $appName=htmlspecialchars(mysql_real_escape_string($_POST['name']));
        $appValue=htmlspecialchars(mysql_real_escape_string($_POST['value']));
        $appDateBegin=htmlspecialchars(mysql_real_escape_string($_POST['date_begin']));
        $appDateEnd=htmlspecialchars(mysql_real_escape_string($_POST['date_end']));
        $appVisible=htmlspecialchars(mysql_real_escape_string($_POST['visible']));
        mysql_query("INSERT INTO applications(name, value, visible, date_begin, date_end) VALUES('$appName','$appValue','$appVisible','$appDateBegin','$appDateEnd')");
        $lastAppId=mysql_result(mysql_query("SELECT max(id) FROM applications"),0);
        //данные о конкурсе записаны
        $tableName='';
        $tableKey='';
        foreach($_POST as $key=>$value){
            $string=explode('_',$key);
            $stringNames=array();
            
            if($string[0]=='table'){
                $zapis=0;
                $tableName=$value;
                $tableKey=$string[1];
                $idOdTables=mysql_query("SELECT id FROM tables WHERE name='$tableName'");
                $colTables=mysql_num_rows($idOdTables);
                //print'<script>alert("'.$colTables.'");</script>';
                if( $colTables > 0 ){
                    
                    for($i=0;$i<$colTables;$i++){
                        $ok=1;
                        $resTableId=mysql_result($idOdTables,$i);
                        $sStringId=mysql_query("SELECT string_id FROM table_id WHERE table_id='$resTableId'");
                        $colStringId=mysql_num_rows($sStringId);
                        for($j=0;$j<$colStringId;$j++){
                            $stringNewId=mysql_result($sStringId,$j);
                            $stringNames[$j]=mysql_result(mysql_query("SELECT name FROM string WHERE id='$stringNewId'"),0);
                            
                        }
                        //$ok=1;
                        $k=0;
                        while($_POST["name_".$string[1]."_".$k]!=""){
                            if($_POST["name_".$string[1]."_".$k]!=$stringNames[$k])
                                $ok=0;
                            //print "<script>alert('".$ok."-".$_POST["name_".$string[1]."_".$k]."-".$stringNames[$k]."-".$k."')</script>";
                            $k++;
                        }
                        if($ok==1)
                            break;
                    }
                    
                        if($ok==1){
                            mysql_query("INSERT INTO app_id(app_id,table_id) VALUES('$lastAppId','$resTableId')");
                            $zapis=1;
                        }else{
                             mysql_query("INSERT INTO tables(name) VALUES('$tableName')");
                    $lastTableId=mysql_result(mysql_query("SELECT max(id) FROM tables"),0);
                    mysql_query("INSERT INTO app_id(app_id, table_id) VALUES('$lastAppId','$lastTableId')");
                    //print "<script>alert('name_".$string[1]."_1');</script>";
                    $k=0;
                    while($_POST["name_".$string[1]."_".$k]!=""){
                        $strName=$_POST["name_".$string[1]."_".$k];
                        $stringId=mysql_result(mysql_query("SELECT id FROM string WHERE name='$strName'"),0);
                            if($stringId>0){
                                mysql_query("INSERT INTO table_id(table_id, string_id) VALUES('$lastTableId','$stringId')");
                            }else{
                                mysql_query("INSERT INTO string(name) VALUES('$strName')");
                                $lastId=mysql_result(mysql_query("SELECT max(id) FROM string"),0);
                                mysql_query("INSERT INTO table_id(table_id, string_id) VALUES('$lastTableId','$lastId')");
                            }
                            $k++;
                        }
                        }
                    
                }else{
                    mysql_query("INSERT INTO tables(name) VALUES('$tableName')");
                    $lastTableId=mysql_result(mysql_query("SELECT max(id) FROM tables"),0);
                    mysql_query("INSERT INTO app_id(app_id, table_id) VALUES('$lastAppId','$lastTableId')");
                    //print "<script>alert('name_".$string[1]."_1');</script>";
                    $k=0;
                    while($_POST["name_".$string[1]."_".$k]!=""){
                        $strName=$_POST["name_".$string[1]."_".$k];
                        $stringId=mysql_result(mysql_query("SELECT id FROM string WHERE name='$strName'"),0);
                            if($stringId>0){
                                mysql_query("INSERT INTO table_id(table_id, string_id) VALUES('$lastTableId','$stringId')");
                            }else{
                                mysql_query("INSERT INTO string(name) VALUES('$strName')");
                                $lastId=mysql_result(mysql_query("SELECT max(id) FROM string"),0);
                                mysql_query("INSERT INTO table_id(table_id, string_id) VALUES('$lastTableId','$lastId')");
                            }
                            $k++;
                        }
                }
                
                    
                }
                //$timeTableID=$string[1];
            }
        }
    
    $sTableName=mysql_query("SELECT id, name FROM tables");
    $colTables=mysql_num_rows($sTableName);
    print "<table style='border:0px;'><tr><td><form action='redactor.php?a=newapp' method='POST'>Название конкурса:<br><textarea name='name'></textarea><br>
            Описание конкурса: <br><textarea name='value'></textarea><br>
            Дата начала: <br><input type='text' name='date_begin'> <br>Дата конца: <br><input type='text' name='date_end'> <br>
            Видимость  <br><select name='visible'><option value='y'>Виден</option><option value='n'>Не виден</option></select> <br><br><select name='tables' size=1 id='tables'>";
    for($i=0;$i<$colTables;$i++){
        $arrTables=mysql_fetch_assoc($sTableName);
        print "<option value='".$arrTables['name']."' id='".$arrTables['id']."'>".$arrTables['name']."</option>";
    }
    print "</select><br>
    Новая таблица:<br>
    Имя таблицы:<br> <input type='text' name='tables_name' id='tables_name'> <br>Количество полей:  <br><input type='text' name='col_columns' id='col_columns'> <br>
    <input type='button' id='button_add' value='Добавить' id='form_submit'> <br><br>
    <div id='td_table'></div><input type='submit' value='Опубликовать' id='form_submit' style='margin-left:-135px; margin-top:15px;'></form></td></tr></table>";
}elseif($_GET['id']!='' AND $_GET['a']=='change'){
    
    $appId=htmlspecialchars(mysql_real_escape_string($_GET['id']));
    $delId=$appId;
    
    //print "<script>alert('".$_POST['name']."===".$_POST['value']."');</script>";
    if(isset($_POST['name']) && isset($_POST['value']) && strlen($_POST['name'])>0 AND strlen($_POST['value'])>0 ){//удаляем все данные о конкурсе, кроме его личных данных в таблице applications
        $userId=mysql_result(mysql_query("SELECT user_id FROM accepted WHERE con_id='$delId'"),0);
        $sAllApplication=mysql_query("SELECT table_id FROM app_id WHERE app_id='$delId'");
        $colTables=mysql_num_rows($sAllApplication);
        for($i=0;$i<$colTables;$i++){
            $tableId=mysql_result($sAllApplication,$i);
            $colAppTables=mysql_num_rows(mysql_query("SELECT id FROM app_id WHERE table_id='$tableId'"));
            if($colAppTables < 2){
                $stringId=mysql_query("SELECT string_id FROM table_id WHERE table_id='$tableId'");
                $colString=mysql_num_rows($stringId);
                for($j=0;$j<$colString;$j++){
                    $resStringId=mysql_result($stringId,$j);
                    print "<script>alert('".mysql_num_rows(mysql_query("SELECT id FROM table_id WHERE string_id='$resStringId'"))."');</script>";
                    if(mysql_num_rows(mysql_query("SELECT id FROM table_id WHERE string_id='$resStringId'")) < 2){
                        mysql_query("DELETE FROM table_id WHERE string_id='$resStringId'");
                        mysql_query("DELETE FROM string WHERE id='$resStringId'");
                    }
                }
                mysql_query("DELETE FROM app_id WHERE table_id='$tableId'");
                mysql_query("DELETE FROM tables WHERE id='$tableId'");
            }
        }
        //mysql_query("DELETE FROM applications WHERE id='$delId'");
        mysql_query("DELETE FROM accepted WHERE con_id='$delId'");
        mysql_query("DELETE FROM request WHERE app_id='$delId'");
    
    

    
        $appName=htmlspecialchars(mysql_real_escape_string($_POST['name']));
        $appValue=htmlspecialchars(mysql_real_escape_string($_POST['value']));
        $appDateBegin=htmlspecialchars(mysql_real_escape_string($_POST['date_begin']));
        $appDateEnd=htmlspecialchars(mysql_real_escape_string($_POST['date_end']));
        $appVisible=htmlspecialchars(mysql_real_escape_string($_POST['visible']));
        mysql_query("UPDATE applications SET name='$appName', value='$appValue', visible='$appVisible', date_begin='$appDateBegin', date_end='$appDateEnd' WHERE id='$appId'");
        
        
        
    
        
        $lastAppId=mysql_result(mysql_query("SELECT max(id) FROM applications"),0);
        //данные о конкурсе записаны
        $tableName='';
        $tableKey='';
        foreach($_POST as $key=>$value){
            $string=explode('_',$key);
            $stringNames=array();
            
            if($string[0]=='table'){
                $zapis=0;
                $tableName=$value;
                $tableKey=$string[1];
                $idOdTables=mysql_query("SELECT id FROM tables WHERE name='$tableName'");
                $colTables=mysql_num_rows($idOdTables);
                //print'<script>alert("'.$colTables.'");</script>';
                if( $colTables > 0 ){
                    
                    for($i=0;$i<$colTables;$i++){
                        $ok=1;
                        $resTableId=mysql_result($idOdTables,$i);
                        $sStringId=mysql_query("SELECT string_id FROM table_id WHERE table_id='$resTableId'");
                        $colStringId=mysql_num_rows($sStringId);
                        for($j=0;$j<$colStringId;$j++){
                            $stringNewId=mysql_result($sStringId,$j);
                            $stringNames[$j]=mysql_result(mysql_query("SELECT name FROM string WHERE id='$stringNewId'"),0);
                            
                        }
                        //$ok=1;
                        $k=0;
                        while($_POST["name_".$string[1]."_".$k]!=""){
                            if($_POST["name_".$string[1]."_".$k]!=$stringNames[$k])
                                $ok=0;
                            //print "<script>alert('".$ok."-".$_POST["name_".$string[1]."_".$k]."-".$stringNames[$k]."-".$k."')</script>";
                            $k++;
                        }
                        if($ok==1)
                            break;
                    }
                    
                        if($ok==1){
                            mysql_query("INSERT INTO app_id(app_id,table_id) VALUES('$appId','$resTableId')");
                            $zapis=1;
                        }else{
                             mysql_query("INSERT INTO tables(name) VALUES('$tableName')");
                    $lastTableId=mysql_result(mysql_query("SELECT max(id) FROM tables"),0);
                    mysql_query("INSERT INTO app_id(app_id, table_id) VALUES('$appId','$lastTableId')");
                    //print "<script>alert('name_".$string[1]."_1');</script>";
                    $k=0;
                    while($_POST["name_".$string[1]."_".$k]!=""){
                        $strName=$_POST["name_".$string[1]."_".$k];
                        $stringId=mysql_result(mysql_query("SELECT id FROM string WHERE name='$strName'"),0);
                            if($stringId>0){
                                mysql_query("INSERT INTO table_id(table_id, string_id) VALUES('$lastTableId','$stringId')");
                            }else{
                                mysql_query("INSERT INTO string(name) VALUES('$strName')");
                                $lastId=mysql_result(mysql_query("SELECT max(id) FROM string"),0);
                                mysql_query("INSERT INTO table_id(table_id, string_id) VALUES('$lastTableId','$lastId')");
                            }
                            $k++;
                        }
                        }
                    
                }else{
                    mysql_query("INSERT INTO tables(name) VALUES('$tableName')");
                    $lastTableId=mysql_result(mysql_query("SELECT max(id) FROM tables"),0);
                    mysql_query("INSERT INTO app_id(app_id, table_id) VALUES('$appId','$lastTableId')");
                    //print "<script>alert('name_".$string[1]."_1');</script>";
                    $k=0;
                    while($_POST["name_".$string[1]."_".$k]!=""){
                        $strName=$_POST["name_".$string[1]."_".$k];
                        $stringId=mysql_result(mysql_query("SELECT id FROM string WHERE name='$strName'"),0);
                            if($stringId>0){
                                mysql_query("INSERT INTO table_id(table_id, string_id) VALUES('$lastTableId','$stringId')");
                            }else{
                                mysql_query("INSERT INTO string(name) VALUES('$strName')");
                                $lastId=mysql_result(mysql_query("SELECT max(id) FROM string"),0);
                                mysql_query("INSERT INTO table_id(table_id, string_id) VALUES('$lastTableId','$lastId')");
                            }
                            $k++;
                        }
                }
                
                    
                }
                //$timeTableID=$string[1];
            }
        }
    
    
    $sAllInfoApp=mysql_query("SELECT * FROM applications WHERE id='$appId'");
        $arrApp=mysql_fetch_assoc($sAllInfoApp);
        $sTableName=mysql_query("SELECT id, name FROM tables");
        $colTables=mysql_num_rows($sTableName);
        $tableApp=mysql_query("SELECT table_id FROM app_id WHERE app_id='$appId'");
        $colTables=mysql_num_rows($tableApp);
    print "<table style='border:0px;'><tr><td><form action='redactor.php?id=".$appId."&a=change' method='POST'>Название конкурса:<br><textarea name='name'>".$arrApp['name']."</textarea><br>
            Описание конкурса: <br><textarea name='value'>".$arrApp['value']."</textarea><br>
            Дата начала: <br><input type='text' name='date_begin' value='".$arrApp['date_begin']."'> <br>Дата конца: <br><input type='text' name='date_end' value='".$arrApp['date_end']."'> <br>
            Видимость  <br><select name='visible'><option value='y'>Виден</option><option value='n'>Не виден</option></select> <br><br><select name='tables' size=1 id='tables'>";
    for($i=0;$i<$colTables;$i++){
        $arrTables=mysql_fetch_assoc($sTableName);
        print "<option value='".$arrTables['name']."' id='".$arrTables['id']."'>".$arrTables['name']."</option>";
    }
    print "</select><br>
    Новая таблица:<br>
    Имя таблицы:<br> <input type='text' name='tables_name' id='tables_name'> <br>Количество полей:  <br><input type='text' name='col_columns' id='col_columns'> <br>
    <input type='button' id='button_add' value='Добавить' id='form_submit'> <br><br>
    <div id='td_table'>";
    
    for($i=0;$i<$colTables;$i++){
        $currentTable=mysql_result($tableApp,$i);
        $currentTableName=mysql_result(mysql_query("SELECT name FROM tables WHERE id='$currentTable'"),0);
        $sAllString=mysql_query("SELECT string_id FROM table_id WHERE table_id='$currentTable'");
        $colString=mysql_num_rows($sAllString);
        print "<textarea name='table_".$i."' id='table_".$i."'>".$currentTableName."</textarea>";
        for($j=0;$j<$colString;$j++){
            $currentStringId=mysql_result($sAllString,$j);
            $currentStringName=mysql_result(mysql_query("SELECT name FROM string WHERE id='$currentStringId'"),0);
            $currentValue=mysql_query("SELECT value FROM request WHERE app_id='$appId' table_id='$currentTable' AND string_id='$currentStringName'");
            print "<div class='div_".$i."'><br>Название:<input type='text' name='name_".$i."_".$j."' class='input_names' value='".$currentStringName."'><select name='select_".$i."_".$j."'><option value='textarea'>Текст</option><option value='file'>Файл</option></select><br></div>";
        }
        print "<input type='button' id='".$i."' value='удалить таблицу' class='button_remove'>";
    }
    
    
    
    print "</div><input type='submit' value='Опубликовать' id='form_submit' style='margin-left:-135px; margin-top:15px;'></form></td></tr></table>";
    
    
    
    
    
    
}


    ?>
    

	
			</div>
	
		</div>
	</div>
</div>	
		
<footer>
	<div id="text_footer">
		Краевое государственное автономное учреждение<br>"Красноясркий краевой фонд поддержеи научной и научно-технической деятльности"
	</div>
</footer>
		
</div>
</body>
</html>