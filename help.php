<?php
    error_reporting (0);
    mysql_connect("localhost","root","slipknot");
    mysql_select_db("good_mark");
    mysql_query("SET CHARSET utf-8");
?>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="images/icon.jpg">
	
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<link href="css/style-2.css" type="text/css" rel="stylesheet">
	<script src="js/modernizr.js"></script>
	<title>Краевой фонд науки | Помощь</title>
</head>
<body>
<div class="wrapper">

<header>

	<div id="hed_main">
		<a href="index.html"><span id="hed_title">Краевой фонд науки</span></a>
	</div>
	<span id="post_header">ДУМАЕМ ГЛОБАЛЬНО</span>
	
	
	<div class="reg_log_panel">
		<a href="#" id="login_pop">Выход</a>
	</div>
	
</header>

<nav>
	<div class="main_menu">
	
		<a href="enter1.php" class="main_menu_buttons">Личный кабинет</a>
		<a href="redactor.php" class="main_menu_buttons">Администратор</a>
		<a href="faq.php" class="main_menu_buttons">ЧАВО</a>
		<a href="news.php" class="main_menu_buttons_link">Новости</a>
		<a href="application.php" class="main_menu_buttons">Просмотр конкурсов</a>
		
	</div>
</nav>


<div class="content">

	<div class="content_box_1">
	
<?
        if($_GET['c']=='newapp'){
            print "
            <p>
                в поле \"название конкурса\" вводится название конкурса, теги вводить нельзя
                \"описание конкурса\" содержит полное описание конкурса, оно же будет распечатано в PDF файле, в начале файла
                дата начала и конца конкурса записывается в любом удобном для администратора виде, теги запрещены
                видимость конкурса определяет то, будет ли конкурс виден для пользователя или нет
                Далее идет список ранее использованных разделов, кликнув по нему мышкой вы можете вставить его в данный конкурс, один раздел может быть вставлен в данный конкурс только один раз
                Имя раздела: вы вводите название нового раздела, который вы хотите добавить
                в \"количество полей\" вы вводите кол-во нужных вам полей для данного раздела и нажимаете кнопку \"добавить\", для каждого поля вы выбираете
                тип поля, где текст-любые символы до 65Кб, строка-256символов, целое число и дробное число
                вы можете удалить как любое из добавленных полей или всю таблицу
                при публикации конкурса, он становится виден всем пользователям.  
            ";
        }elseif($_GET['c']=='newapp')
        
        
?>

    </div>
</div>

<footer>
	<div id="text_footer">
		Краевое государственное автономное учреждение<br>"Красноясркий краевой фонд поддержеи научной и научно-технической деятльности"
	</div>
</footer>

</div>

<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>