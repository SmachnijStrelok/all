<?php
header('Content-Type: text/html; charset=utf-8');
$db = mysql_connect("localhost", "root", "slipknot");//подключение к БД
mysql_select_db("good_mark");
error_reporting (0);?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/icon.jpg">
	<title>Краевой фонд науки - Регистрация</title>
	<script type="text/javascript" src="jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<script>
		$(document).ready(function() {
		function getUrlVars()//для более удобного обращения с GET переменными
		{
			var vars = [], hash;
			var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
			for(var i = 0; i < hashes.length; i++)
			{
				hash = hashes[i].split('=');
				vars.push(hash[0]);
				vars[hash[0]] = hash[1];
			}
			return vars;
		}
			get=getUrlVars()['a'];
			
		if(get==undefined){//подсвечиваем текущую страницу
			$("#page_reestr").attr('class','main_menu_buttons main_menu_current_page');
		}else if(get=='newapp'){
			$("#page_add").attr('class','main_menu_buttons main_menu_current_page');
		}
		});
		
	</script>
</head>
<body id="top_page">
<div class="wrapper">
	<header>
		<div id="hed_main">
			<a href="index.html"><span id="hed_title">Краевой фонд науки</span></a>
		</div>
		<span id="post_header">ДУМАЕМ ГЛОБАЛЬНО</span>
	</header>

	<nav>
		<div class="main_menu">
			<a href="index.html" class="main_menu_buttons" id='page_index'>Главная</a>
			<a href="redactor.php" class="main_menu_buttons" id='page_reestr'>Реестр заявок</a>
			<a href="redactor.php?a=newapp" class="main_menu_buttons" id='page_add'>Добавление конкурса</a>
			<a href="texpanel.php?c=faq" class="main_menu_buttons">Техпанель</a>
		</div>
	</nav>


<div class="content">

	<div class="content_2">
	
		<aside>
		
			<div id="aside_buttons_all">
			
				<a href="#" class="aside_buttons button_1"><span>Пусто</span></a>
				
				<a href="#" class="aside_buttons button_2"><span>Пусто</span></a>
				
				<a href="#" class="aside_buttons button_3"><span>Пусто</span></a>
				
				<a href="#" class="aside_buttons button_4"><span>Пусто</span></a>
				
				<a href="#" class="aside_buttons button_5"><span>Пусто</span></a>
				
				<a href="#" class="aside_buttons button_6"><span>Пусто</span></a>
				
			</div>
			
		</aside>
	
		<div class="content_box_1">
		
			<div class="inline_content_box_1">

				<?php
							class PrintInformation{//информация о пользователе принимает ID пользователя
								
								public function printUserInformation( $userId ) {
								if(is_int($userId)){
									$sInformation = mysql_query("SELECT * FROM users WHERE user_id='$userId'");
									$arrInformation = mysql_fetch_assoc( $sInformation );
									$jobId = $arrInformation['job'];
									$job = mysql_result(mysql_query("SELECT job FROM job WHERE job_id='$jobId'"), 0);
									if( $arrInformation['gender'] == 'male' ){
										$sex='Мужской';
									}else{
										$sex='Женский';
									}
									print "<p class='label'>Фамилия:</p>"
										.$arrInformation['surname'].
										"<p class='label'>Имя:</p>"
										.$arrInformation['name'].
										"<p class='label'>Отчество:</p>"
										.$arrInformation['middle_name'].
										"<p class='label'>Дата Рождения:</p>"
										.$arrInformation['date_birth'].
										"<p class='label'>Пол:</p>"
										.$sex.
										"<p class='label'>Домашний адрес:</p>"
										.$arrInformation['adress'].
										"<p class='label'>Домашний индекс:</p>"
										.$arrInformation['p_index'].
										"<p class='label'>Подразделение:</p>"
										.$arrInformation['podrazd'].
										"<p class='label'>Должность:</p>"
										.$job.
										"<p class='label'>Электронный адрес:</p>"
										.$arrInformation['email'].
										"<p class='label'>Контактный телефон:</p>"
										.$arrInformation['phone'].
										"<p class='label'>Дата регистрации:</p>"
										.$arrInformation['dates'];
								}else{
									//print "<script>alert('Аргумент функции function printUserInformation( userId ) может быть только натуральным числом!');</script>";
								}
							}
								
						   public function printOrgInformation($orgId){//информация об организации принимает ID организации
							if(is_int($userId)){
								$sInformation=mysql_query("SELECT * FROM organizations WHERE id_org='$orgId'");
								$arrInformation=mysql_fetch_assoc($sInformation);

								print "<p class='label'>Название организации:</p>"
									.$arrInformation['name'].
									"<p class='label'>ИНН:</p>"
									.$arrInformation['inn'].
									"<p class='label'>КПП:</p>"
									.$arrInformation['kpp'].
									"<p class='label'>ОГРН:</p>"
									.$arrInformation['ogrn'].
									"<p class='label'>ОКПО:</p>"
									.$arrInformation['okpo'].
									"<p class='label'>ОКАТО:</p>"
									.$arrInformation['okato'].
									"<p class='label'>Основной вид экономической деятельности:</p>"
									.$arrInformation['oved'].
									"<p class='label'>Юридический адрес:</p>"
									.$arrInformation['ur_adress'].
									"<p class='label'>Фактический адрес:</p>"
									.$arrInformation['f_adress'].
									"<p class='label'>Адрес для корреспонденции:</p>"
									.$arrInformation['kor_adress'].
									"<p class='label'>Факс:</p>"
									.$arrInformation['fax'].
									"<p class='label'>Телефон:</p>"
									.$arrInformation['phone'].
									"<p class='label'>Электронный адрес:</p>"
									.$arrInformation['email'];
							
								}else{
									//print "<script>alert('Аргумент функции function printOrgInformation( userId ) может быть только натуральным числом!');</script>";
								}
							}
								
								
							public function TableAllApplications(){//распечатка всех конкурсов
								$sAllApplication=mysql_query("SELECT * FROM applications");
								$colApplications=mysql_num_rows($sAllApplication);
								
								print "<table class='table table-redactor-applist'><tr class='table-cell_title'>
								<td class='table-cell'><span>Номер</span></td>
								<td class='table-cell'><span>Название конкурса</span></td>
								<td class='table-cell'><span>Дата начала</span></td>
								<td class='table-cell'><span>Дата окончания</span></td>
								<td class='table-cell'><span>Изменить</span></td></tr>";
								
								for($i=0;$i<$colApplications;$i++){//вытаскиваем всю нужную инфу о конкурсе и выводим ее
									$arrayApplications=mysql_fetch_assoc($sAllApplication);
									print "<tr><td class='table-cell'><span>".$arrayApplications['id']."</span></td>
										<td class='table-cell'><a href='redactor.php?id=".$arrayApplications['id']."' class='table-link'>".$arrayApplications['name']."</a></td>
										<td class='table-cell'><span>".$arrayApplications['date_begin']."</span></td>
										<td class='table-cell'><span>".$arrayApplications['date_end']."</span></td>
										<td class='table-cell'><a href='redactor.php?id=".$arrayApplications['id']."&a=change' class='table-link'>Редактировать</a></td></tr>";

								}
								
								print "</table>";
							}
								
							public function DeleteApplication($appId){//удаление конкурса
								
								$delId=htmlspecialchars(mysql_real_escape_string($appId));
								
								if($appId != ''){//если ID конкурса не пустой

									$userId=mysql_result(mysql_query("SELECT user_id FROM accepted WHERE con_id='$delId'"),0);
									$sAllApplication=mysql_query("SELECT table_id FROM app_id WHERE app_id='$delId'");
									$colTables=mysql_num_rows($sAllApplication);
									
									for($i=0;$i<$colTables;$i++){//сначала вытаскиваем ID всех таблиц принадлежащих конкурсу
										
										$tableId=mysql_result($sAllApplication,$i);
										$colAppTables=mysql_num_rows(mysql_query("SELECT id FROM app_id WHERE table_id='$tableId'"));
										
										if($colAppTables < 2){//если эта таблица используется только в этом конкурсе, можем удалять
											
											$stringId=mysql_query("SELECT string_id FROM table_id WHERE table_id='$tableId'");//ID всех строк принадлежащих таблицам
											$colString=mysql_num_rows($stringId);
											
											for($j=0;$j<$colString;$j++){
												
												$resStringId=mysql_result($stringId,$j);
												print "<script>alert('".mysql_num_rows(mysql_query("SELECT id FROM table_id WHERE string_id='$resStringId'"))."');</script>";
												
												if(mysql_num_rows(mysql_query("SELECT id FROM table_id WHERE string_id='$resStringId'")) < 2){//проверяем не используются ли в других разделах эти строки
													mysql_query("DELETE FROM table_id WHERE string_id='$resStringId'");
													mysql_query("DELETE FROM string WHERE id='$resStringId'");
												}
											}
											//mysql_query("DELETE FROM app_id WHERE table_id='$tableId'");
											mysql_query("DELETE FROM tables WHERE id='$tableId'");
										}
									}
									//подчищаем таблицы
									mysql_query("DELETE FROM app_id WHERE table_id='$delId'");//чо то не то
									mysql_query("DELETE FROM applications WHERE id='$delId'");
									mysql_query("DELETE FROM accepted WHERE con_id='$delId'");
									mysql_query("DELETE FROM request WHERE app_id='$delId'");
								}
								
							}
								
							public function AllRequest($appId){//все заявки на конкурс
								
								$checkId=htmlspecialchars(mysql_real_escape_string($appId));
								print "<form action='redactor.php?id=".$checkId."' method='POST' id='form_selection'>
									<div class='redactor-filter'>
										<label class='radio_name'>
											<input type='radio' name='selection' value='d' id='all'>Отклоненные
										</label>
										
										<label class='radio_name'>
											<input type='radio' name='selection' value='y' id='y'>Принятые
										</label>
										
										<label class='radio_name'>
											<input type='radio' name='selection' value='n' id='n'>Непринятые
										</label>
										
										<button type='submit' value='Фильтровать' class='submit_button-simple'>Фильтровать</button></form>
									</div>
								
									<table class='table table-redactor'><tr class='table-cell_title'>
									<td class='table-cell'><span>Просмотр</span></td>
									<td class='table-cell'><span>Пользователь</span></td>
									<td class='table-cell'><span>Организация</span></td>
									<td class='table-cell'><span>Дата подачи</span></td>
									<td class='table-cell'><span>Состояние</span></td>
									<td class='table-cell'><span><a href='redactor.php?id=".$checkId."&del_id=".$checkId."' class='table-link'>Удалить</a></span></td></tr>";
								
							}
								
							public function SortingRequest($appId, $pattern){//сортировка заявок на принятые/непросмотренные/отклоненные
								
								$checkId=htmlspecialchars(mysql_real_escape_string($appId));
								$sApp=mysql_query("SELECT * FROM accepted WHERE con_id='$checkId' AND accepted='$pattern'");
								$colApp=mysql_num_rows(mysql_query("SELECT id FROM accepted WHERE con_id='$checkId' AND accepted='$pattern'"));
								
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
								
							public function UserRequest($checkId, $checkUser){//печатаем заявку пользователя
								
								$sTables=mysql_query("SELECT table_id FROM app_id WHERE app_id='$checkId'");//получаем Н записей с номерами таблиц которые есть в данном конкурсе
								$colTables=mysql_num_rows($sTables);
								$sUserFile=mysql_result(mysql_query("SELECT file_name FROM app_file WHERE user_id='$checkUser' AND app_id='$checkId'"),0);
								if($sUserFile!=""){
									print "<a href='applications/".$checkId."/".$sUserFile.".zip'>Download</a>";
								}
								print "<form action='redactor.php?id=".$checkId."&user=".$checkUser."' method='POST'>";
								for( $i = 0; $i < $colTables; $i ++ ){

									$idTable=mysql_result($sTables,$i);
									$nameTable=mysql_result(mysql_query("SELECT name FROM tables WHERE id='$idTable'"),0);
									$sStringId=mysql_query("SELECT string_id FROM table_id WHERE table_id='$idTable'");
									$colString=mysql_num_rows($sStringId);
									print "<span class='table_label'>".$nameTable."</span><br>";

									for( $j = 0 ; $j < $colString ; $j ++ ){

										$idString=mysql_result($sStringId,$j);//идентификатор строки
										$id=mysql_result(mysql_query("SELECT id FROM request WHERE table_id='$idTable' AND string_id='$idString' AND user_id='$checkUser'"),0);
										$nameString=mysql_result(mysql_query("SELECT name FROM string WHERE id='$idString'"),0);//получаем название строки
										$userValue=mysql_result(mysql_query("SELECT value FROM request WHERE string_id='$idString' AND user_id='$checkUser'"),0);//получаем значение введенное пользователем
										print "<span class='table_label_2'>".$nameString.":</span><br><textarea class='textarea textarea-redactor-newapp' name='".$idString."' cols=40 rows=4>".$userValue."</textarea><br>";
									}
								}
							}
						}

						
                if($_COOKIE['login']=='admin'&&$_COOKIE['password']=='admin'){
                $PrintInformation=new PrintInformation();
					if(@$_GET['id']=='' && @$_GET['user']=='' && @$_GET['a']==''){//если все GET переменные пустые отображаем список конкурсов
						
							$PrintInformation->TableAllApplications();    
						
					}elseif($_GET['id']!='' && $_GET['user']=='' && $_GET['a']==''){//если ID не пустой то отображаем заявки на этот конкурс
						
						if($_GET['del_id']!=''){//если ID конкурса для удаления не пустой то удаляем его
							$PrintInformation->DeleteApplication($_GET['del_id']); 
						}
						
						 $PrintInformation->AllRequest($_GET['id']);
						
						 $PrintInformation->SortingRequest($_GET['id'], $_POST['selection']);
						
						
					}elseif(@$_GET['id']!='' && @$_GET['user']!='' && @$_GET['a']==''){//просмотр заявки определенного пользователя
						$checkId=htmlspecialchars(mysql_real_escape_string($_GET['id']));
						$checkUser=htmlspecialchars(mysql_real_escape_string($_GET['user']));
						
						$array=array();
						$val='';
						foreach($_POST as $key=>$value) {//если админ поменял значения полей пользователя, то тогда обновляем их
							//$key = $value;
							//$val=htmlspecialchars(mysql_real_escape_string($_POST[$key]));
							if($key=='accept'){
								mysql_query("UPDATE accepted SET accepted='$value' WHERE con_id='$checkId' AND user_id='$checkUser'");
							}
							$x=mysql_real_escape_string(htmlspecialchars($value));
							//print "<script>alert('".$key."');</script>";
							//print "+++".$key."---".$x;
							mysql_query("UPDATE request SET value='$x' WHERE string_id='$key'");
						}
						$orgId=mysql_result(mysql_query("SELECT org_id FROM accepted WHERE user_id='$checkUser' AND con_id='$checkId'"),0);
						//print "<script>alert('".$orgId."---".$checkId."---".$checkUser."');</script>";
						print "<table class='table table-redactor-newapp' ><tr class='table-cell_title'><td class='table-cell table-cell-redactor'>";
						$PrintInformation->printUserInformation($checkUser);
						print "</td><td class='table-cell table-cell-redactor'>";
						$PrintInformation->printOrgInformation($orgId);
						print "</td></tr><tr class='table-cell_title'><td class='table-cell table-cell-redactor'>";
						
					$PrintInformation->UserRequest($checkId, $checkUser);
						
						print"	<div class='redactor-filter redactor-filter_2'>
									<label class='radio_name radio_name-redactor'>
										<input type='radio' class='radio_name' name='accept' value='y' id='y'>Принять
									</label>
									<label class='radio_name radio_name-redactor'>
										<input type='radio' class='radio_name' name='accept' value='d' id='d'>Отклонить
									</label>
									
									<label class='radio_name radio_name-redactor'>
										<input type='radio' class='radio_name' name='accept' value='n' id='n'>Не фильтровать
									</label>
								</div>
								<p><input type='submit' class='submit_button_1'></p></form></td></tr></table>";
						
					}elseif($_GET['a']=='newapp'){//добавление нового конкурса
						if(isset($_POST['name'])){
							//print $_POST['name'];
							 //foreach($_POST as $key=>$value){
							  //   print $key."---".$value."<br>";
							 //}
							//проверка переменных 
							$appName=htmlspecialchars(mysql_real_escape_string($_POST['name']));
							$appValue=htmlspecialchars(mysql_real_escape_string($_POST['value']));
							$appDateBegin=htmlspecialchars(mysql_real_escape_string($_POST['date_begin']));
							$appDateEnd=htmlspecialchars(mysql_real_escape_string($_POST['date_end']));
							$appVisible=htmlspecialchars(mysql_real_escape_string($_POST['visible']));
							$appFile=htmlspecialchars(mysql_real_escape_string($_POST['file_app']));
							mysql_query("INSERT INTO applications(name, value, visible, date_begin, date_end, file_info) VALUES('$appName','$appValue','$appVisible','$appDateBegin','$appDateEnd','$appFile')");//записываем информацию о конкурсе
							$lastAppId=mysql_result(mysql_query("SELECT max(id) FROM applications"),0);
							//данные о конкурсе записаны
							$tableName='';
							$tableKey='';
							foreach($_POST as $key=>$value){//перебираем все пост переменные 
								$string=explode('_',$key);//разделяем строку на подстроки и получаем смысл переменной
								$stringNames=array();
								
								if($string[0]=='table'){//если это название таблицы
									$zapis=0;
									$tableName=$value;
									$tableKey=$string[1];
									$idOdTables=mysql_query("SELECT id FROM tables WHERE name='$tableName'");
									$colTables=mysql_num_rows($idOdTables);
									//print'<script>alert("'.$colTables.'");</script>';
									if( $colTables > 0 ){//если уже такая таблица есть
										
										for($i=0;$i<$colTables;$i++){//перебираем все похожие таблицы
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
											if($ok==1)//если находим таблицу полностью совпадающую с нашей то дальше не проверям и выходим из цикла
												break;
										}
										
											if($ok==1){//просто в данный конкурс записываем ID таблицы с которой все совпало
												mysql_query("INSERT INTO app_id(app_id,table_id) VALUES('$lastAppId','$resTableId')");
												$zapis=1;
											}else{//если такая таблица есть но не все строки совпадают с введенной, то создаем новую, но используем все старые(совпашие-ранее созданные строки)
												 mysql_query("INSERT INTO tables(name) VALUES('$tableName')");
										$lastTableId=mysql_result(mysql_query("SELECT max(id) FROM tables"),0);
										mysql_query("INSERT INTO app_id(app_id, table_id) VALUES('$lastAppId','$lastTableId')");
										//print "<script>alert('name_".$string[1]."_1');</script>";
										$k=0;
										while($_POST["name_".$string[1]."_".$k]!=""){
											$strName=$_POST["name_".$string[1]."_".$k];
											$strType=$_POST["select_".$string[1]."_".$k];
											$stringId=mysql_result(mysql_query("SELECT id FROM string WHERE name='$strName'"),0);
												if($stringId>0){
													mysql_query("INSERT INTO table_id(table_id, string_id) VALUES('$lastTableId','$stringId')");
												}else{
													mysql_query("INSERT INTO string(name,type) VALUES('$strName','$strType')");
													$lastId=mysql_result(mysql_query("SELECT max(id) FROM string"),0);
													mysql_query("INSERT INTO table_id(table_id, string_id) VALUES('$lastTableId','$lastId')");
												}
												$k++;
											}
											}
										
									}else{//если такой таблицы нет и строк совпаших нет, то мы создаем новую таблицу и записываем все в нее
										mysql_query("INSERT INTO tables(name) VALUES('$tableName')");
										$lastTableId=mysql_result(mysql_query("SELECT max(id) FROM tables"),0);
										mysql_query("INSERT INTO app_id(app_id, table_id) VALUES('$lastAppId','$lastTableId')");
										//print "<script>alert('name_".$string[1]."_1');</script>";
										$k=0;
										while($_POST["name_".$string[1]."_".$k]!=""){
											$strName=$_POST["name_".$string[1]."_".$k];
											$strType=$_POST["select_".$string[1]."_".$k];
											$stringId=mysql_result(mysql_query("SELECT id FROM string WHERE name='$strName'"),0);
												if($stringId>0){
													mysql_query("INSERT INTO table_id(table_id, string_id) VALUES('$lastTableId','$stringId')");
												}else{
													mysql_query("INSERT INTO string(name, type) VALUES('$strName','$strType')");
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
						print "<table class='table table-redactor-newapp'>
								<tr><td><form action='redactor.php?a=newapp' method='POST'>
								<label class='label label-redactor-newapp'>Название конкурса:
									<input name='name' class='form_style' required>
								</label>
								
								<label class='label label-redactor-newapp'>Описание конкурса:
									<textarea name='value' class='textarea textarea-redactor-newapp' required></textarea>
								</label>
								
								<label class='label label-redactor-newapp'>Дата начала:
									<input type='text' class='form_style' name='date_begin' required>
								</label>
								
								<label class='label label-redactor-newapp'>Дата конца:
									<input type='text' class='form_style' name='date_end' required>
								</label>
								
								<label class='label label-redactor-newapp'>Видимость
									<select name='visible' class='selector_style' required>
										<option value='y'>Виден</option><option value='n'>Не виден</option>
									</select>
								</label>
								
								<label class='label label-redactor-newapp_2'>Выбор существующей таблицы
									<select name='tables' class='selector_style selector_style-redactor-newapp_tables' id='tables'>";
										for($i=0;$i<$colTables;$i++){//вытаскиваем все разделы из БД
											$arrTables=mysql_fetch_assoc($sTableName);
											print "<option value='".$arrTables['name']."' id='".$arrTables['id']."'>".$arrTables['name']."</option>";
										}
										print "</select>
								</label>
								
								<label class='label label-redactor-newapp_2'>Новая таблица</label><br>
								
								<label class='label label-redactor-newapp_3'>Имя таблицы:
									<input type='text' class='form_style' name='tables_name' id='tables_name' required>
								</label>
								
								<label class='label label-redactor-newapp_3'>Количество полей:
									<input type='text' class='form_style' name='col_columns' id='col_columns' required>
								</label>
								
								<input type='button' id='button_add' value='Добавить' class='submit_button_2 submit_button_2-redactor-newapp'> <br><br>
								
								<label class='label label-redactor-newapp'>Описание для прикладываемых файлов:
									<textarea name='file_app' class='textarea textarea-redactor-newapp'></textarea>
								</label><br><br>
								<div id='td_table'></div><input type='submit' value='Опубликовать' class='submit_button_1 submit_button_1-redactor-newapp'></form></td></tr></table>";
					}elseif($_GET['id']!='' AND $_GET['a']=='change'){//если мы хотим изменить конкурс
						
						$appId=htmlspecialchars(mysql_real_escape_string($_GET['id']));//получае его ID
						$delId=$appId;
						
						//print "<script>alert('".$_POST['name']."===".$_POST['value']."');</script>";
						if(isset($_POST['name']) && isset($_POST['value']) && strlen($_POST['name'])>0 AND strlen($_POST['value'])>0 ){//удаляем все данные о конкурсе, кроме его личных данных в таблице applications
							$userId=mysql_result(mysql_query("SELECT user_id FROM accepted WHERE con_id='$delId'"),0);
							$sAllApplication=mysql_query("SELECT table_id FROM app_id WHERE app_id='$delId'");
							$colTables=mysql_num_rows($sAllApplication);
							for($i=0;$i<$colTables;$i++){
								$tableId=mysql_result($sAllApplication,$i);
								$colAppTables=mysql_num_rows(mysql_query("SELECT id FROM app_id WHERE table_id='$tableId'"));
								//print "<script>alert('colTables:".$colAppTables."');</script>";
								if($colAppTables < 2){
									$stringId=mysql_query("SELECT string_id FROM table_id WHERE table_id='$tableId'");
									$colString=mysql_num_rows($stringId);
									for($j=0;$j<$colString;$j++){
										$resStringId=mysql_result($stringId,$j);
										//print "<script>alert('".mysql_num_rows(mysql_query("SELECT id FROM table_id WHERE string_id='$resStringId'"))."');</script>";
										if(mysql_num_rows(mysql_query("SELECT id FROM table_id WHERE string_id='$resStringId'")) < 2){
											mysql_query("DELETE FROM table_id WHERE string_id='$resStringId'");
											mysql_query("DELETE FROM string WHERE id='$resStringId'");
										}
									}
									//mysql_query("DELETE FROM app_id WHERE table_id='$tableId'");
									mysql_query("DELETE FROM tables WHERE id='$tableId'");
								}
							}
							//mysql_query("DELETE FROM applications WHERE id='$delId'");
							mysql_query("DELETE FROM app_id WHERE app_id='$delId'");
							mysql_query("DELETE FROM accepted WHERE con_id='$delId'");
							mysql_query("DELETE FROM request WHERE app_id='$delId'");
						
						

							//все основные данные о конкурсе
							$appName=htmlspecialchars(mysql_real_escape_string($_POST['name']));
							$appValue=htmlspecialchars(mysql_real_escape_string($_POST['value']));
							$appDateBegin=htmlspecialchars(mysql_real_escape_string($_POST['date_begin']));
							$appDateEnd=htmlspecialchars(mysql_real_escape_string($_POST['date_end']));
							$appVisible=htmlspecialchars(mysql_real_escape_string($_POST['visible']));
							$appFile=htmlspecialchars(mysql_real_escape_string($_POST['file_app']));
							mysql_query("UPDATE applications SET name='$appName', value='$appValue', visible='$appVisible', date_begin='$appDateBegin', date_end='$appDateEnd', file_info='$appFile' WHERE id='$appId'");
							

							
							$lastAppId=mysql_result(mysql_query("SELECT max(id) FROM applications"),0);
							//данные о конкурсе записаны
							$tableName='';
							$tableKey='';
							foreach($_POST as $key=>$value){
								$string=explode('_',$key);
								$stringNames=array();
								
								if($string[0]=='table'){//точно так же как и при добавлении конкурса записываем данные о нем
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
							$sTableName=mysql_query("SELECT id,name FROM tables");
							$colTables=mysql_num_rows($sTableName);
							$tableApp=mysql_query("SELECT table_id FROM app_id WHERE app_id='$appId'");
							$colTables=mysql_num_rows($sTableName);
							print $colTables;
						print "<table class='table table-redactor-newapp'>
								<tr><td><form action='redactor.php?id=".$appId."&a=change' method='POST'>
								
								<label class='label label-redactor-newapp'>Название конкурса:
									<input name='name' class='form_style' value='".$arrApp['name']."'>
								</label>
								
								<label class='label label-redactor-newapp'>Описание конкурса:
									<textarea name='value' class='textarea textarea-redactor-newapp'>".$arrApp['value']."</textarea>
								</label>								
								
								<label class='label label-redactor-newapp'>Дата начала:
									<input type='text' class='form_style' name='date_begin' value='".$arrApp['date_begin']."'>
								</label>
								
								<label class='label label-redactor-newapp'>Дата конца:
									<input type='text' class='form_style' name='date_end' value='".$arrApp['date_end']."'>
								</label>
								
								<label class='label label-redactor-newapp'>Видимость
									<select name='visible' class='selector_style' required>
										<option value='y'>Виден</option><option value='n'>Не виден</option>
									</select>
								</label>
								
								<label class='label label-redactor-newapp_2'>Выбор существующей таблицы
									<select name='tables' class='selector_style selector_style-redactor-newapp_tables' id='tables'>";
										for($i=0;$i<$colTables;$i++){//вытаскиваем все разделы из БД
											$arrTables=mysql_fetch_assoc($sTableName);
											print "<option value='".$arrTables['name']."' id='".$arrTables['id']."'>".$arrTables['name']."</option>";
										}
										print "</select>
								</label>						
						
								<label class='label label-redactor-newapp_2'>Новая таблица</label><br>
								
								<label class='label label-redactor-newapp_3'>Имя таблицы:
									<input type='text' class='form_style' name='tables_name' id='tables_name' required>
								</label>
								
								<label class='label label-redactor-newapp_3'>Количество полей:
									<input type='text' class='form_style' name='col_columns' id='col_columns' required>
								</label>
								
								<input type='button' id='button_add' value='Добавить' class='submit_button_2 submit_button_2-redactor-newapp'> <br><br>
								
								<label class='label label-redactor-newapp'>Описание для прикладываемых файлов:
									<textarea name='file_app' class='textarea textarea-redactor-newapp'></textarea>
								</label><br><br>

						
						<div id='td_table'>";
						$colTables=mysql_num_rows($tableApp);
						for($i=0;$i<$colTables;$i++){
							$currentTable=mysql_result($tableApp,$i);
							$currentTableName=mysql_result(mysql_query("SELECT name FROM tables WHERE id='$currentTable'"),0);
							$sAllString=mysql_query("SELECT string_id FROM table_id WHERE table_id='$currentTable'");
							$colString=mysql_num_rows($sAllString);
							print "<textarea class='textarea textarea-redactor-newapp' name='table_".$i."' id='table_".$i."'>".$currentTableName."</textarea><input type='button' class='string_add' id='str_".$i."' value='Добавить строку'>";//i i currentTableName
							for($j=0;$j<$colString;$j++){
								$currentStringId=mysql_result($sAllString,$j);
								$currentStringName=mysql_result(mysql_query("SELECT name FROM string WHERE id='$currentStringId'"),0);
								$currentValue=mysql_query("SELECT value FROM request WHERE app_id='$appId' table_id='$currentTable' AND string_id='$currentStringName'");
								print "<div class='div_".$i."' id='div_".$i."_".$j."'>
								<label class='label'>Название:
									<input type='text' name='name_".$i."_".$j."' value='".$currentStringName."' class='input_names'>
								</label>
								<input type='button' value='Удалить строку' id='".$i."_".$j."' class='string_remove submit_button-simple'>
								<select name='select_".$i."_".$j."'>
								<option value='text'>Текст</option><option value='int'>Целое число</option><option value='float'>Число с плавающей точкой</option><option value='string'>Строка(256 символов)</option></select></div>";//lastId=i i=j
							}
							print "<input type='button' id='".$i."' value='Удалить таблицу' class='button_remove submit_button-simple'>";
						}

						print "</div><input type='submit' value='Опубликовать' class='submit_button_1 submit_button_1-redactor-newapp'></form></td></tr></table>";

					}
                }
					
				?>
   
			</div>
		</div>
	</div>
</div>	
		
	<footer>
		<a href="#top_page" class="up_page_btn"></a>
		
		<div id="text_footer">
			Краевое государственное автономное учреждение<br>"Красноярский краевой фонд поддержки научной и научно-технической деятельности"		</div>
	</footer>
	
</div>

<script src="js/jquery-2.1.1.js"></script>
<script src="js/main.js"></script>
</body>
</html>