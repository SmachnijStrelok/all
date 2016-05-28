<?php
error_reporting (0);//отключаем ошибки
      function connect($host, $user, $pass, $db){//подключение к БД
        mysql_connect($host, $user, $pass);
        mysql_select_db($db);
        mysql_query("SET CHARSET utf-8");
    }
    
    function checkUser(){//проверка совпадают ли веденные пользователем маил/пароль с его оригинальными, если да возвращаем 1
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
connect('localhost','root','slipknot','good_mark');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/icon.jpg">
	<title>Краевой фонд науки | Техпанель</title>
	<script type="text/javascript" src="jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="caret.js"></script>
	<script type="text/javascript" src="form.js"></script>
	<link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body onload="setFocus()" id="top_page">
<div class="wrapper">
	<header>
		<div id="hed_main">
			<a href="index.html"><span id="hed_title">Краевой фонд науки</span></a>
		</div>
		<span id="post_header">ДУМАЕМ ГЛОБАЛЬНО</span>
	</header>

	<nav>
		<div class="main_menu">
		    <a href="index.html" class="main_menu_buttons">Главная</a>
			<a href="texpanel.php?c=faq" class="main_menu_buttons" id="page_faq">ЧАВО</a>
			<a href="texpanel.php?c=faq&a=add" class="main_menu_buttons" id='page_addfaq'>Добавить ЧАВО</a>
			<a href="texpanel.php?c=news" class="main_menu_buttons" id='page_news'>Новости</a>
			<a href="texpanel.php?c=news&a=add" class="main_menu_buttons" id='page_addnews'>Добавить новость</a>
		</div>
	</nav>

<script>

    function getUrlVars()//функция для удобного обращения к GET переменным
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
        
        category=getUrlVars()['c'];
        actions=getUrlVars()['a'];
        //В зависимости от того, в какой категории мы находимся, подсвечиваем ее назване для наглядности 
    if(category=='faq' && actions==undefined){
        $("#page_faq").attr('class','main_menu_buttons main_menu_current_page');
    }else if(category=='faq' && actions=='add'){
        $("#page_addfaq").attr('class','main_menu_buttons main_menu_current_page');
    }else if(category=='news' && actions==undefined){
        $("#page_news").attr('class','main_menu_buttons main_menu_current_page');
    }else if(category=='news' && actions=='add'){
        $("#page_addnews").attr('class','main_menu_buttons main_menu_current_page');
    }

</script>

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
					$check=checkUser();
					if($_COOKIE['login']=='admin'&&$_COOKIE['password']=='admin'){
						if($_GET['c']=='news' AND $_GET['a']==''){//выводим для редактирования список всех новостей
							$sAllNews=mysql_query("SELECT * FROM news");//вытаскиваем все данные из таблицы новостей
							$colNews=mysql_num_rows($sAllNews);
							for($i=0;$i<$colNews;$i++){//в цикле выводим их на экран
								$arr=mysql_fetch_assoc($sAllNews);
								print "<div class='texpanel-newslist'><input class='form_style form_style-texpanel' type='text' name='title' class='".$arr['new_id']."' value='".$arr['title']."' id='title'>
								<textarea class='textarea textarea-texpanel' name='intro_text' class='".$arr['new_id']."' id='intro_text'>".$arr['intro_text']."</textarea>
								<textarea class='textarea textarea-texpanel' name='full_text' class='".$arr['new_id']."' id='full_text'>".$arr['full_text']."</textarea>
								<input type='text' class='form_style form_style-texpanel' name='dates' placefolder='Введите дату' class='".$arr['new_id']."' value='".$arr['dates']."' id='dates'>
								<input type='button' value='Изменить' name='update' id='".$arr['new_id']."' class='submit_button_2 submit_button_2-texpanel-edit' class='do_it'>
								<input type='button' value='Удалить' name='remove' id='".$arr['new_id']."' class='submit_button_2 submit_button_2-texpanel-del' class='do_it'></div>";
							}
						}elseif($_GET['c']=='news' AND $_GET['a']=='add'){//добавление новой новости
							if(isset($_POST['new_title']) AND isset($_POST['new_intro']) AND isset($_POST['new_full']) AND isset($_POST['new_dates']) ){//если все поля были заполнены...
								//проверка полей натеги и sql-инъекции
								$new_title=htmlspecialchars(mysql_real_escape_string($_POST['new_title']));
								$new_intro=mysql_real_escape_string($_POST['new_intro']);
								$new_full=mysql_real_escape_string($_POST['new_full']);
								$new_dates=htmlspecialchars(mysql_real_escape_string($_POST['new_dates']));
								mysql_query("INSERT INTO news(title, intro_text, full_text, dates) VALUES('$new_title','$new_intro','$new_full','$new_dates')");//записываем все в таблицу
								print "<script>alert('Данные успешно записаны')</script>";
							}
							//далее небольшой набор для умного поля ввода, см в form.js
									print '<div id="main">
									<div>
										<form action="texpanel.php?c=news&a=add" method="POST">
											<label class="label label-texpanel-addnews">Название новости:
												<input type="text" class="form_style form_style-texpanel" name="new_title" >
											</label>
											<textarea name="new_intro" class="textarea textarea-texpanel"></textarea>
											<textarea id="description" class="textarea textarea-texpanel" name="new_full"></textarea>
											<input type="text" class="form_style form_style-texpanel" name="new_dates">
											<input type="submit" class="submit_button_1" value="Опубликовать">
										</form>
									
									<label class="label label-texpanel-addnews">Предварительный просмотр:</label>
									<div id="preview"></div>
									<div id="menu">
										<a href="#" id="bold"><b>Ж</b></a>
										<a href="#" id="italic"><i>К</i></a>
										<a href="#" id="underline"><u>Ч</u></a>
										<a href="#" id="h2"><b>h2</b></a>
										<a href="#" id="h3"><b>h2</b></a>
										<a href="#" id="jg"><b>CCC</b></a>
										<a href="#" id="link">Ссылка</a>
										<a href="#" id="right">ПК</a>
										<a href="#" id="center">Ц</a>
										<a href="#" id="image">IMG</a>
									</div>
								</div>
							</div>';
						}elseif($_GET['c']=='faq' AND $_GET['a']==''){//отображаем все вопросы и ответы в ЧАВО, с возможностью их удаления и изменения
							$sAllQuestions=mysql_query("SELECT * FROM faq");
							$colQuestion=mysql_num_rows($sAllQuestions);
							for($i=0;$i<$colQuestion;$i++){
								
								$arr=mysql_fetch_assoc($sAllQuestions);
								print "<div class='texpanel-newslist'>
								<textarea class='textarea textarea-texpanel' name='question' class='".$arr['id']."' id='question'>".$arr['question']."</textarea>
								<textarea class='textarea textarea-texpanel' name='answer' class='".$arr['id']."' id='answer'>".$arr['answer']."</textarea>
								<input type='button' value='Изменить' name='update' id='".$arr['id']."' class='submit_button_2 submit_button_2-texpanel-edit' class='quest'>
								<input type='button' value='Удалить' name='remove' id='".$arr['id']."' class='submit_button_2 submit_button_2-texpanel-del' class='quest'></div>";
							}
						}elseif($_GET['c']=='faq' AND $_GET['a']=='add'){//добавление нового "вопроса-ответа" в ЧАВО
							if(isset($_POST['question']) AND isset($_POST['answer'])){
								$title=htmlspecialchars(mysql_real_escape_string($_POST['title']));
								$question=mysql_real_escape_string($_POST['question']);
								$answer=mysql_real_escape_string($_POST['answer']);
								mysql_query("INSERT INTO faq(title, question, answer) VALUES('$title','$question','$answer')");
								print "<script>alert('Данные успешно записаны')</script>";
							}
									print '
									<form action="texpanel.php?c=faq&a=add" method="POST">
										<label class="label label-texpanel-addnews">Вопрос:
											<textarea name="question" class="textarea textarea-texpanel textarea-texpanel-small"></textarea>
										</label>
										
										<label class="label label-texpanel-addnews">Ответ:
											<textarea class="textarea textarea-texpanel" name="answer"></textarea><br><input type="submit" class="submit_button_1" value="Опубликовать">
										</label>
									</form>';
						}
					}else{
						 print "Неверный логин или пароль!";
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