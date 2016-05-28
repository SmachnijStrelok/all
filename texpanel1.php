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
    <html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="images/icon.jpg">
<title>Краевой фонд науки - Регистрация</title>
<script type="text/javascript" src="jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="caret.js"></script>
<script type="text/javascript" src="form.js"></script>
<link href="css/style.css" type="text/css" rel="stylesheet">
<style>
    
     /*body { font-size:13px; font-family:Lucida Sans, Lucida Sans Unicode, Arial, Sans-Serif; color:#666; margin:20px;}*/
        #main { width:; margin: 0px auto; border:solid 1px #b2b3b5; -moz-border-radius:10px; padding:20px; background-color:#f6f6f6;}
        #menu {padding:5px; background-color:#f5f5f5;background-color:rgb(245, 245, 245); display:none; 
               /*position:relative; top:0px; left:0px;*/ overflow:hidden;
               border:solid 1px #929292; border-radius:3px; -moz-border-radius:3px; -webit-border-radius:3px; 
               box-shadow: 5px 5px 5px #888; -moz-box-shadow: 1px 1px 3px #555; -webkit-box-shadow: 5px 5px 5px #888;}
        #menu:hover {background-color:rgba(245, 245, 245, 1);}
        #menu a { padding:3px 5px; border:solid 1px transparent; color:#000; text-decoration:none; font-size:14px;
            float:left; display:block; text-align:center;}
        #menu a:hover { border:solid 1px #bea881; background-color:#fff2cb;
            background: -moz-linear-gradient(top, rgba(255, 251, 239, 1), rgba(255, 220, 87, 1));
            border-radius:3px; -moz-border-radius:3px; -webit-border-radius:3px; }
        #preview { width:400px; background-color:#f8f8f8; border:solid 1px #929292; padding:10px;
            border-radius:3px; -moz-border-radius:3px; -webit-border-radius:3px;}
        #preview b, #preview u, #preview i {color:#c30;}
    
</style>
</head>
<body onload="setFocus()">
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
    $check=checkUser();
    if($check==1){
        if($_GET['c']=='news' AND $_GET['a']==''){//выводим для редактирования список всех новостей
            $sAllNews=mysql_query("SELECT * FROM news");//вытаскиваем все данные из таблицы новостей
            $colNews=mysql_num_rows($sAllNews);
            for($i=0;$i<$colNews;$i++){//в цикле выводим их на экран
                $arr=mysql_fetch_assoc($sAllNews);
                print "<div style='margin-top:50px;'><input style='width:450px;' type='text' name='title' class='".$arr['new_id']."' value='".$arr['title']."' id='title'><br><br>
                <textarea  style='width:450px;height:80px;' name='intro_text' class='".$arr['new_id']."' id='intro_text'>".$arr['intro_text']."</textarea><br><br>
                <textarea style='width:450px;height:140px' name='full_text' class='".$arr['new_id']."' id='full_text'>".$arr['full_text']."</textarea><br><br>
                <input style='width:450px;' type='text' name='dates' class='".$arr['new_id']."' value='".$arr['dates']."' id='dates'><br>
                <input type='button' value='удалить' name='remove' id='".$arr['new_id']."' style='margin-right:310px;' class='do_it'><input type='button' value='изменить' name='update' id='".$arr['new_id']."' class='do_it'><br><br></div>";
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
                    print '<div id="main" style="margin-bottom:50px;">
                    <div>
                    <p style="font-size:16px;">
                    <br />
                    <form action="texpanel.php?c=news&a=add" method="POST">
                    Название новости:
                    <input type="text" name="new_title" style="width:420px;"><br><br>
                    <textarea name="new_intro" rows="5" cols="50"></textarea><br><br>
                    <textarea id="description" rows="8" cols="50" name="new_full"></textarea><br><br><input type="text" name="new_dates" style="width:420px;"><br><br><input type="submit" value="Отправить"></form>
                    
                    </p>
                    Предварительный просмотр:
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
                print "<div style='margin-top:50px;margin-bottom:50px;padding-bottom:50px;'>
                <textarea  style='width:450px;height:80px;' name='question' class='".$arr['id']."' id='question'>".$arr['question']."</textarea><br><br>
                <textarea style='width:450px;height:140px' name='answer' class='".$arr['id']."' id='answer'>".$arr['answer']."</textarea><br><br>
                <input type='button' value='удалить' name='remove' id='".$arr['id']."' style='margin-right:310px;' class='quest'><input type='button' value='изменить' name='update' id='".$arr['id']."' class='quest'><br><br></div>";
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
                    <form action="texpanel.php?c=faq&a=add" method="POST" style="margin-top:25px;">
                        Вопрос:<br>
                        <textarea name="question" rows="5" cols="50"></textarea><br><br>
                        Ответ:<br>
                        <textarea rows="8" cols="50" name="answer"></textarea><br><br><input type="submit" value="Отправить">
                    </form>';
        }
    }else{
         print "Неверный логин или пароль!";
    }


?>
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