<?php
error_reporting (0);//отключаем ошибки
class Registration{
    public function connect($host, $user, $pass, $db){//подключение к БД
    mysql_connect($host, $user, $pass);
    mysql_select_db($db);
    mysql_query("SET CHARSET utf-8");
    }
    
    public function checkOnCoinc($email, $passOne, $passTwo){//1-все ок регаем, 2-совпадают емэйлы, 3- совпадают мыла и пароли, 4- мыло норм а пароли не совпадают
        
        $coincEmail=mysql_num_rows(mysql_query("SELECT user_id FROM users WHERE email='$email'"));//если число=1 то пользователи с таким мылом уже есть
        $coincPass=($passOne==$passTwo);
        if($coincEmail==0 AND $coincPass==true){
            return 1;
        }elseif($coincEmail==1 AND $coincPass==true){
            return 2;
        }elseif($coincEmail==1 AND $coincPass==false){
            return 3;
        }elseif($coincEmail==0 AND $coincPass==false){
            return 4;
        }
    }
    
    public function checkInsertData($dataArray){//проверка введенных данных при регистрации
        $vars="";
        $name=htmlspecialchars(mysql_real_escape_string($_POST['name']));
        $surname=htmlspecialchars(mysql_real_escape_string($_POST['surname']));
        $middle_name=htmlspecialchars(mysql_real_escape_string($_POST['middle_name']));
        $date_birth=htmlspecialchars(mysql_real_escape_string($_POST['date_birth']));
        $adress=htmlspecialchars(mysql_real_escape_string($_POST['adress']));
        $p_index=htmlspecialchars(mysql_real_escape_string($_POST['p_index']));
        $phone=htmlspecialchars(mysql_real_escape_string($_POST['phone']));
        $id_org=htmlspecialchars(mysql_real_escape_string($_POST['id_org']));
        $podrazd=htmlspecialchars(mysql_real_escape_string($_POST['podr']));
        $job=htmlspecialchars(mysql_real_escape_string($_POST['job']));
        $email=htmlspecialchars(mysql_real_escape_string($_POST['email_form']));
        $password=md5(htmlspecialchars(mysql_real_escape_string($_POST['password'])));
        $gender=htmlspecialchars(mysql_real_escape_string($_POST['gender']));
        $id_org1=mysql_result(mysql_query("SELECT id_org FROM organizations WHERE name='$id_org'"),0);
        
        $rand=md5(rand(1,32000)*rand(1,16000)."".time());
        mysql_query("INSERT INTO users(surname, name, middle_name, date_birth, gender, adress, p_index, phone, id_org, podrazd, job , email, md5_password ,time_id, dates)
        VALUES('$surname','$name','$middle_name','$date_birth','$gender','$adress','$p_index','$phone','$id_org1','$podrazd','$job','$email','$password','$rand','".time()."')");
        setcookie("timekey",$rand);//записываем в БД
    }
    
    
}

$reg=new Registration();
$reg->connect('localhost','root','slipknot','good_mark');
if(isset($_POST['name'])&&strlen($_POST['name'])>1){
    $num=$reg->checkOnCoinc($_POST['email_form'],$_POST['password'],$_POST['check_password']);
    
    if($num==1)
        $reg->checkInsertData($_POST);
    elseif($num==2)
        print "Один пользователь-один емэйл";
    elseif($num==2)
        print "Один пользователь-один емэйл, пароли не совпадают";
    elseif($num==2)
        print "Пароли не совпадают";
}


$sName=mysql_query("SELECT name FROM organizations");
$col_string=mysql_num_rows($sName);
$sJob=mysql_query("SELECT job FROM job");
$colJob=mysql_num_rows($sJob);
?>




<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="images/icon.jpg">
<title>Краевой фонд науки - Регистрация</title>
<link href="css/style.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="jquery-2.2.3.min.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $('#id_org').change(function() {//при клике на одну из организаций вытаскиваем все данные о ней
                
                value=$(this).val();
                //alert(value);
                $.post('block.php', {id:value}, function(data) {
                    //$('#content').html(data);
                   obj=JSON.parse(data);
                    alert(obj.inn);
                    //obj = jQuery.parseJSON("data":"abc","reg":"aaa");
                    $("#inn").attr('value',obj.inn);
                    $("#kpp").attr('value',obj.kpp);
                    $("#ogrn").attr('value',obj.ogrn);
                    $("#okpo").attr('value',obj.okpo);
                    $("#okato").attr('value',obj.okato);
                    $("#oved").attr('value',obj.oved);
                    $("#ur_adress").attr('value',obj.ur_adress);
                    $("#f_adress").attr('value',obj.f_adress);
                    $("#kor_adress").attr('value',obj.kor_adress);
                    $("#fax").attr('value',obj.fax);
                    $("#org_phone").attr('value',obj.phone);
                    $("#email").attr('value',obj.email);
                    //alert(obj.inn); // будет выведено "John"
                    //alert("aaa");
                });
            });
        });
    </script>
</head>
<body id="top_page">
<div class="wrapper">
	<header>
		<div id="hed_main">
			<a href="index.html"><span id="hed_title">Краевой фонд науки</span></a>
		</div>
		<p id="post_header">ДУМАЕМ ГЛОБАЛЬНО</p>
	</header>

	<nav>
		<div class="main_menu">
			<a href="index.html" class="main_menu_buttons">Главная</a>
			<a href="#" class="main_menu_buttons">Подать заявку</a>
			<a href="#" class="main_menu_buttons">Реестр заявок</a>
			<a href="#" class="main_menu_buttons">Помощь</a>
		</div>
	</nav>


<div class="content">

	<div class="registration_form">
	
		<span class="page_title reg_title">Регистрация</span>
	
		<div class="reg_info">
			<span>Для заполнения форм воспользуйтесь следующими рекомендациями:</span>
			<ul>
				<li> ..................</li>
				<li> ...................</li>
			</ul>
		</div>
		
		<div class="fieldsets">	
			<form action="reg1.php" method="POST" name="registration">
				<div class="fieldset_1">
				
					<label class="label">Фамилия:
						<span class="tooltip anim" tabindex="0">подсказка по вводу
							<span>Вводите только буквы русского алфавита.<br>Максимальная длина: 15 символов.</span>
						</span>
						
						<p><input type="text" pattern="[А-ЯЁ][а-яё]+$" name="surname" maxlength="20" placeholder="Введите фамилию"
							required title="Вводите только буквы русского алфавита, начиная с заглавной. Максимальная длина: 15 символов." class="form_style reg_form_style"></p>
					</label>
					
					<label class="label">Имя:
						<span class="tooltip anim" tabindex="0">подсказка по вводу
							<span>Вводите только буквы русского алфавита, начания с заглавной. <br>Максимальная длина: 15 символов.</span>
						</span>
						
						<p><input type="text" pattern="[А-ЯЁ][а-яё]+$" name="name" maxlength="15" placeholder="Введите имя"
							required title="Вводите только буквы русского алфавита, начания с заглавной. Максимальная длина: 15 символов." class="form_style reg_form_style"></p>
					</label>
					
					<label class="label">Отчество:
						<span class="tooltip anim" tabindex="0">подсказка по вводу
							<span>Вводите только буквы русского алфавита, начания с заглавной. <br>Максимальная длина: 15 символов.</span>
						</span>
					
						<p><input type="text" pattern="[А-ЯЁ][а-яё]+$" name="middle_name" maxlength="20" placeholder="Введите отчество"
							required title="Вводите только буквы русского алфавита, начания с заглавной. Максимальная длина: 15 символов." class="form_style reg_form_style"></p>
					</label>
					
					<label class="label">Дата рождения:
						<p><input type="date" pattern="[0-3][0-9].[0-1][0-9].19[0-9]{2}" name="date_birth" maxlength="10" placeholder="дд.мм.гггг"
							required title="Выберете дату в календаре. Если календарь не отображается, введите дату в формате 'дд.мм.гггг'." class="form_style reg_form_style"></p>
					</label>
					
					<label class="label" for="sex">Пол:</label>
					
							<p><label class="radio_name">Мужской<input type="radio" name="gender" value="male" checked>
							
							</label>
							
							<label class="radio_name">Женский<input type="radio" name="gender" value="female">
							</label></p>
				</div>
				
				<div class="fieldset_2">
					<label class="label">Домашний адрес:
						<p class="post_form">Пример: г. Москва, Ломоносовский пр-т, д.31, корп.2, кв.15</p>
							<p><input type="text" name="adress" maxlength="50" placeholder="Введите адрес" required id="address" class="form_style reg_form_style"></p>
					</label>

					<label class="label">Домашний индекс:
						<p><input type="text" pattern="[0-9]{6}" name="p_index" maxlength="6" placeholder="Введите домашний индекс"
							required title="Вводите только цифры." class="form_style reg_form_style"></p>
					</label>
					
					<label class="label">Номер телефона:
						<span class="tooltip anim" tabindex="0">подсказка по вводу
							<span nowrap>Введите номер телефона в формате: <br>(ххх)-ххх-хххх</span>
						</span>

						<p><input type="tel" pattern="[(][0-9]{3}[)]-[0-9]{3}-[0-9]{4}" maxlength="14" name="phone"
							placeholder="Введите номер телефона" required title="Пожалуйста, придерживайтесь формата по вводу номера телефона: (xxx)-xxx-xxxx" class="form_style reg_form_style"></p>
					</label>
					
				</div>
				
				<div class="fieldset_3">
					<label class="label">Наименование организации:
						   <p><select id="id_org" class="selector_style form_reg_selector" name='id_org'>
							   <?php
									for($i=0;$i<$col_string;$i++){
										print "<option value='".mysql_result($sName,$i)."' class='reg'>".mysql_result($sName,$i)."</option>";
									}
							   ?>
							</select></p>
					</label>
					
					<label class="label">ИНН:
						<p><input type="text" pattern="[0-9]{10}" name="inn" maxlength="10" placeholder="Введите ИНН"
						title="Вводите только цифры." required id="inn" class="form_style reg_form_style" id='inn'></p>
					</label>
					
					<label class="label">KПП:
						<p><input type="text" pattern="[0-9]{9}" name="kpp" maxlength="9" placeholder="Введите KПП"
						title="Вводите только цифры." required id="kpp" class="form_style reg_form_style" id='kpp'></p>
					</label>
					
					<label class="label">ОГРН:
						<p><input type="text" pattern="[0-9]{13}" name="ogrn" maxlength="13" placeholder="Введите ОГРН"
						title="Вводите только цифры." required id="ogrn" class="form_style reg_form_style"  id='ogrn'></p>
					</label>
					
					<label class="label">ОКПО:
						<p><input type="text" pattern="[0-9]{8}" name="okpo" maxlength="8" placeholder="Введите ОКПО"
						title="Вводите только цифры." required id="okpo" class="form_style reg_form_style"  id='okpo'></p>
					</label>
					
					<label class="label">ОКАТО:
						<p><input type="text" pattern="[0-9]{11}" name="okato" maxlength="11" placeholder="Введите ОКАТО"
						title="Вводите только цифры." required id="okato" class="form_style reg_form_style"  id='okato'></p>
					</label>
					
					<label class="label">Основной вид экономической деятельности:
						<p><input type="text" pattern="^[А-Яа-яЁё\s]+$"  name="oved" maxlength="100"
							placeholder="Введите основной вид экономической деятельности" title="Вводите только буквы русского алфавита." required id="oved" class="form_style reg_form_style" id='oved'></p>
					</label>
					
					<label class="label">Юридический адрес:
						<p class="post_form">Пример: г. Москва, Ломоносовский пр-т, д.31, корп.2, кв.15</p>
							<p><input type="text" id='ur_adress'  name="ur_address" maxlength="50" placeholder="Введите юридический адрес" required id="ur_adress" class="form_style reg_form_style"></p>
					</label>
					
					<label class="label">Фактический адрес:
						<p><input type="text" id='f_adress' name="f_address" maxlength="50" placeholder="Введите фактический адрес" required id="f_adress" class="form_style reg_form_style"></p>
					</label>
					
					<label class="label">Адрес для корреспонденции:
						<p><input type="text" id='kor_adress' name="kor_address" maxlength="50" placeholder="Введите адрес для корреспонденции" required id="kor_adress" class="form_style reg_form_style"></p>
					</label>
					
					<label class="label">Факс:
						<p><input type="tel" id='fax' pattern="[(][0-9]{3}[)]-[0-9]{3}-[0-9]{4}"  name="fax"maxlength="14" placeholder="Введите факс"
							required title="Введите номер факса в формате: (ххх)-ххх-хххх" id="fax" class="form_style reg_form_style"></p>
					</label>
					
					<label class="label">Телефон:
						<p><input type="tel" id='org_phone' pattern="[(][0-9]{3}[)]-[0-9]{3}-[0-9]{4}" maxlength="14" name="phone"
						placeholder="Введите номер телефона" required title="Введите номер телефона в формате: (ххх)-ххх-хххх" id="phone" class="form_style reg_form_style"></p>
					</label>
						
					<label class="label">Электронный адрес:
						<p><input type="email" name="email" maxlength="20" placeholder="Введите E-mail" required id="email" class="form_style reg_form_style"></p>
					</label>
					
					<label class="label">Подразделение:
						<p><input type="text" pattern="^[А-Яа-яЁё\s]+$"  name="podr" maxlength="50" placeholder="Введите подразделение"
						title="Вводите только буквы русского алфавита." class="form_style reg_form_style"></p>
					</label> 
					
					<label class="label">Должность:
						<p><select class="selector_style form_reg_selector" name='job'>
								<?php
									for($i=0;$i<$colJob;$i++){
										print "<option value='".mysql_result($sJob,$i)."'>".mysql_result($sJob,$i)."</option>";
									}
								?>
							</select></p>
					</label>
					
				</div>
				
				<div class="fieldset_4">
				
					<label class="label">Адрес электронной почты:
						<p><input type="email" name="email_form" maxlength="20" placeholder="Введите E-mail" required class="form_style reg_form_style"></p>
					</label>
					
					<label class="label">Пароль:
						<p><input type="password" name="password" maxlength="25" placeholder="Введите пароль" required class="form_style reg_form_style"></p>
					</label>
					
					<label class="label">Подтверждение пароля:
						<p><input type="password" name="check_password" maxlength="25" placeholder="Подтвердите пароль" required class="form_style reg_form_style"></p>
					</label>
					
				</div>
				
				<div class="form_accept">
				
					<label id="soglasie"><input type="checkbox" name="soglasie" required>Согласие на обработку персональных данных</label>
						<p><input type="submit" name="form_submit" alt="Отправить" class="submit_button_1" value="Зарегистрироваться"></p>
						
				</div>
			</form>
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