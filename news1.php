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
		<a href="news.php" class="main_menu_buttons main_menu_current_page">Новости</a>
		<a href="application.php" class="main_menu_buttons">Просмотр конкурсов</a>
		
	</div>
</nav>


<div class="content">

	<div class="content_box_1">

		<!--<div class="inline_content_box_1">-->
		<div class="content-faq">
				<section class="cd-faq">
					<div class="cd-faq-items">
                        <?php
                        $sAllNews=mysql_query("SELECT * FROM news");
                                    $colNews=mysql_num_rows($sAllNews);
                                    for($i=0;$i<$colNews;$i++){//вытаскиваем с БД все новости и печатаем их
                                        $arr=mysql_fetch_assoc($sAllNews);
                                        print '<ul class="cd-faq-group">
                                                    <li>
                                                        <a class="cd-faq-trigger" href="#">'.$arr['title'].'<br><span class="a_img">'.$arr['intro_text'].'</span></a>
                                                        <div class="cd-faq-content">
                                                            <p> '.$arr['full_text'].'<br><br>'.$arr['dates'].' </p>
                                                        </div>
                                                    </li>
                                                  </ul>';
                                    }



                        ?>

					</div>
					<a href="#0" class="cd-close-panel">Close</a>
				</section>
			<!--</div>-->
		</div>
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