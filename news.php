<?php
error_reporting (0);//отключаем ошибки
//подключаемся к БД
mysql_connect("localhost","root","slipknot");
mysql_select_db("good_mark");
mysql_query("SET CHARSET utf-8");
?>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/icon.jpg">
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<script src="js/modernizr.js"></script>
	<title>Краевой фонд науки | Помощь</title>
</head>
<body id="top_page">
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
		<a href="news.php" class="main_menu_buttons main_menu_current_page">Новости</a>
		<a href="application.php" class="main_menu_buttons">Просмотр конкурсов</a>
		
	</div>
</nav>


<div class="content">
	<div class="content_box_1 content_box-faq">
		<span class="page_title page_title-faq">Новости</span>
		<div class="inline_content_box_1 inline_content_box_1-faq">
			<section class="cd-faq">
					<?php
					$sAllNews=mysql_query("SELECT * FROM news");
								$colNews=mysql_num_rows($sAllNews);
								for($i=0;$i<$colNews;$i++){//вытаскиваем с БД все новости и печатаем их
									$arr=mysql_fetch_assoc($sAllNews);
									print '<ul class="cd-faq-group">
												<li>
													<a class="cd-faq-trigger cd-news-trigger" href="#0">
														<img class="news_img" src="'.$arr['intro_text'].'">
														<span class="news_title">'.$arr['title'].'</span>
														<div class="news_date">Дата публикации: '.$arr['dates'].'</div>
													</a>
													<div class="cd-faq-content cd-news-content">
														<p>'.$arr['full_text'].'</p>
													</div>
												</li>
											</ul>';
								}
					?>
			</section>
		</div>
	</div>
</div>

<footer>
	<a href="#top_page" class="up_page_btn"></a>
	
	<div id="text_footer">
		Краевое государственное автономное учреждение<br>"Красноясркий краевой фонд поддержеи научной и научно-технической деятльности"
	</div>
</footer>

</div>

<script src="js/jquery-2.1.1.js"></script>
<script src="js/main.js"></script>
</body>
</html>