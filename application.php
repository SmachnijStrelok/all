<?php
error_reporting (0);
header('Content-Type: text/html; charset=utf-8');
$db = mysql_connect("localhost", "root", "slipknot");
mysql_select_db("good_mark");

    function checkUser(){//проверка данных пользователя
        $check=-1;
            if(isset($_POST["email"])&&isset($_POST["password"])){
        $pEmail=htmlspecialchars(mysql_real_escape_string($_POST["email"]));
        $pPassword=md5(htmlspecialchars(mysql_real_escape_string($_POST["password"])));
                //print $pEmail."  ".$pPassword;
        $checkEmail=mysql_result(mysql_query("SELECT user_id FROM users WHERE email='$pEmail'"),0);
        $checkPassword=mysql_result(mysql_query("SELECT user_id FROM users WHERE md5_password='$pPassword'"),0);
        if($checkEmail!=""&&$checkPassword!=""){
            $rand=md5(rand(1,32000)*rand(1,16000)."".time());
            setcookie("timekey",$rand);
            mysql_query("UPDATE users SET time_id='$rand' WHERE email='$pEmail'");
            $check=1;
        }else
            print "Ошибка, неверные данные!";

        }elseif($_COOKIE['timekey']!=""){
                //print $_COOKIE['timekey'];
            $timeId=htmlspecialchars(mysql_real_escape_string($_COOKIE['timekey']));
                //print $timeId;
            $checkCookie=mysql_result(mysql_query("SELECT name FROM users WHERE time_id='$timeId'"),0);
            if($checkCookie!=""){
                $check=1;
            }
     
        }
        return $check;
    }

$check=checkUser();
error_reporting (0);?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/icon.jpg">
	<script type="text/javascript" src="jquery-2.2.3.min.js"></script>
	<title>Краевой фонд науки | Просмотр конкурсов</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
<body id="top_page">
<div class="wrapper">
	<header>
		<div id="hed_main">
			<a href="index.html"><span id="hed_title">Краевой фонд науки</span></a>
		</div>
		<span id="post_header">ДУМАЕМ ГЛОБАЛЬНО</span>
	</header>

	<?php
		if($check==1){//в зависимости от того вошел ли пользователь печатаем разные меню
		print '<nav>
				<div class="main_menu">
					<a href="index.html" class="main_menu_buttons">Главная</a>
					<a href="enter1.php" class="main_menu_buttons">Личный кабинет</a>
					<a href="enter1.php?c=update" class="main_menu_buttons">Редактирование профиля</a>
					<a href="enter1.php?c=request" class="main_menu_buttons">Просмотр заявок</a>
					<a href="application.php" class="main_menu_buttons main_menu_current_page">Подача заявки</a>
				</div>
			</nav>';
		}else{
		  print '<nav>
		<div class="main_menu">
			<a href="enter.html" class="main_menu_buttons">Личный кабинет</a>
			<a href="texpanel.html" class="main_menu_buttons">Администратор</a>
			<a href="faq.php" class="main_menu_buttons">ЧАВО</a>
			<a href="news.php" class="main_menu_buttons">Новости</a>
			<a href="application.php" class="main_menu_buttons main_menu_current_page">Просмотр конкурсов</a>
		</div>
		</nav>';
		}   
	?>


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

					if($_GET['id']==''){//выводим на экран все конкурсы
						$sAllApplication=mysql_query("SELECT * FROM applications");
						$colApplications=mysql_num_rows($sAllApplication);
						print "<table class='table table-application-applist'><tr class='table-cell_title'>
								<td class='table-cell'><span>Номер</span></td>
								<td class='table-cell'><span>Название конкурса</span></td>
								<td class='table-cell'><span>Дата начала</span></td>
								<td class='table-cell'><span>Дата окончания</span></td></tr>";
						for($i=0;$i<$colApplications;$i++){
							$arrayApplications=mysql_fetch_assoc($sAllApplication);
							if($arrayApplications['visible']!='n'){
								print "<tr><td class='table-cell'><span class='table-text'>".$arrayApplications['id']."</span></td>
									<td class='table-cell'><a href='application.php?id=".$arrayApplications['id']."' class='table-link'>".$arrayApplications['name']."</a></td>
									<td class='table-cell'><span class='table-text'>".$arrayApplications['date_begin']."</span></td>
									<td class='table-cell'><span class='table-text'>".$arrayApplications['date_end']."</span></td></tr>";
							}
						}    
						print "</table>";
					}elseif($_GET['id']!='' && $_GET['do']==''){//выводим данные о конкретном конкурсе
						$getAppId=htmlspecialchars(mysql_real_escape_string($_GET['id']));
						$sApp=mysql_query("SELECT * FROM applications WHERE id='$getAppId'");
						$arrApp=mysql_fetch_assoc($sApp);
						$colAppTables=mysql_num_rows(mysql_query("SELECT table_id FROM app_id WHERE app_id='$getAppId'"));
						print "<h2 class='name app-name'>".$arrApp['name']."</h2>
						<p class='app-info'>".$arrApp['value']."</p>
						<p class='app-info'>Дата начала: <b>".$arrApp['date_begin']."</b></p>
						<p class='app-info'>Дата начала: <b>".$arrApp['date_end']."</b></p>";
						if($colAppTables>0){
							print "<h3><a href='application.php?id=".$getAppId."&do=app' class='submit_button_1' >Заполнить заявку</a></h3>";
							}else{
								print "<h3>Данный конкурс пока доступен только для просмотра, для заполнения он станет доступен сразу после поступления точных данных о нем.</h3>";
							}
						
					}elseif($_GET['id']!='' && $_GET['do']=='app'){//заполнение заявки на конкурс
						$check=checkUser();
						$userKey=$_COOKIE['timekey'];
						$getUserId=mysql_result(mysql_query("SELECT user_id FROM users WHERE time_id='$userKey'"),0);
						if($check==1){
							$getAppId=htmlspecialchars(mysql_real_escape_string($_GET['id']));//id конкурса
							//$getUserId=htmlspecialchars(mysql_real_escape_string($_GET['us_id']));
							if(mysql_result(mysql_query("SELECT user_id FROM accepted WHERE user_id='$getUserId' AND con_id='$getAppId'"),0)==""){//если пользователь еще не подавал заявок на этот конкурс
								if(sizeof($_POST)>0){// если пользователь ввел данные то начинаем записывать
									foreach($_POST as $key => $value){

										$val=mysql_real_escape_string(htmlspecialchars($value, ENT_COMPAT, 'cp1251'));
										$arrKey=explode('_',$key);
										$tableId=$arrKey[0];
										$stringId=$arrKey[1];
										//print $tableId."---".$stringId."---".$val;
										mysql_query("INSERT INTO request(app_id, table_id, string_id, value, user_id) VALUES('$getAppId','$tableId','$stringId','$val','$getUserId')");
									}
									

									$name = md5($getAppId."_".$getUserId."_".time());//будущее имя файла
									if (isset($_FILES['user_file']['name'])) {
											$file_name = $_FILES['user_file']['name']; 
											$filetype1 = explode('.', $file_name);
											$filetype = $filetype1[count($filetype1)-1];
										$name=$name.".".$filetype;
										if ($filetype == "zip" || $filetype == "rar" || $filetype == "7z" && $_FILES['FILE']['size'] != 0){ 
											if(is_uploaded_file($_FILES['user_file']['tmp_name'])) { 
												if(mkdir("applications/".$getAppId, 0777, true)){
													print "Директория добавлена!";
												}else{
													print "Директория НЕ добавлена!";
												}
												if (move_uploaded_file($_FILES['user_file']['tmp_name'], "applications/".$getAppId."/".basename($name.'.'.$filetype))) 
													echo "Файл успешно загружен!";
											}
										}
									}
									mysql_query("INSERT INTO app_file(app_id, user_id, file_name) VALUES('$getAppId','$getUserId','$name')");//записываем путь к файлу в таблицу
									
									
									$dates=time();
									$org_id=mysql_result(mysql_query("SELECT id_org FROM users WHERE user_id='$getUserId'"),0);
									mysql_query("INSERT INTO accepted(user_id, con_id, accepted, dates, org_id) VALUES('$getUserId','$getAppId','n','$dates','$org_id')");

								}
								$sApplication=mysql_query("SELECT table_id FROM app_id WHERE app_id='$getAppId'");
								$colTables=mysql_num_rows($sApplication);
								print "<div id='request'><table class='table table-userinfo'><tr><td class='table-cell table-userinfo'><form action='application.php?id=".$getAppId."&do=app&us_id=2' method='POST' enctype = 'multipart/form-data'>";
								for($i=0;$i<$colTables;$i++){//распечатываем все поля для заполнения в конкурсе
									$tableId=mysql_result($sApplication,$i);
									print "<p class='table_label'>".mysql_result(mysql_query("SELECT name FROM tables WHERE id='$tableId'"),0)."</p>";
									$sAllString=mysql_query("SELECT string_id FROM table_id WHERE table_id='$tableId'");
									$colString=mysql_num_rows($sAllString);
									for($j=0;$j<$colString;$j++){
										$stringId=mysql_result($sAllString,$j);
										$stringName=mysql_result(mysql_query("SELECT name FROM string WHERE id='$stringId'"),0);
										$stringType=mysql_result(mysql_query("SELECT type FROM string WHERE id='$stringId'"),0);
										
										$input="<textarea class='textarea' name='".$tableId."_".$stringId."'></textarea><br>";
										if($stringType=='text'){
											$input="<textarea class='textarea' name='".$tableId."_".$stringId."'></textarea><br>";
										}elseif($stringType=='int'){
											$input="<input class='form_style' type='text' pattern='[0-9]{0,10}' name='".$tableId."_".$stringId."'><br>";
										}elseif($stringType=='float'){
											$input="<input class='form_style' type='text' pattern='\d+(\.\d{0,5})?' name='".$tableId."_".$stringId."'><br>";
										}elseif($stringType=='string'){
											$input="<input class='form_style' type='text' pattern='[A-Za-zА-Яа-яЁё0-9_- ]{0,256}' name='".$tableId."_".$stringId."'><br>";
										}
										print "<p class='app-info'>".$stringName."</p><br>".$input;

									}
								}
								$fileInfo=mysql_result(mysql_query("SELECT file_info FROM applications WHERE id='$getAppId'"),0);
								if($fileInfo!=""){
									print "<p class='app-info'>".$fileInfo."</p><br><br>
									<input type='file' name='user_file'>";
								}
								print "<br><input type='submit' id='form_submit_1' class='submit_button_1'></form></td></tr></div> ";
							}else{
								print "<script>alert('Вы не можете подвавать на один конкурс более одной заявки!');</script>";
							}
						}else{
							print "Эта функция доступна только для зарегестрированных пользователей";
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
			Краевое государственное автономное учреждение<br>"Красноярский краевой фонд поддержки научной и научно-технической деятельности"</div>
	</footer>
	
</div>

<script src="js/jquery-2.1.1.js"></script>
<script src="js/main.js"></script>
</body>
</html>