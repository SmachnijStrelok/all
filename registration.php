<?php
    $db = mysql_connect("localhost", "root", "slipknot");
    mysql_select_db("good_mark");
    mysql_query("SET CHARSET windows-1251");
    $sName=mysql_query("SELECT name FROM organizations");
    $sJob=mysql_query("SELECT job FROM job");
    $col_string=mysql_num_rows($sName);
    $colJob=mysql_num_rows($sJob);
//проверить на одинаковые емэйлы
//проверить равенство паролей
//записать куки
@print "<script>alert('".$_POST['name']."---".$_POST['surname']."---".$_POST['middle_name']."---".$_POST['birthday']."---".$_POST['sex']."---".$_POST['adress']."---".$_POST['home_index']."---".$_POST['tel']."---".$_POST['org_name']."---".$_POST['podr']."---".$_POST['job']."---".$_POST['email_form']."---".$_POST['password']."');</script>";
@$pEmail=htmlspecialchars(mysql_real_escape_string($_POST['email_form']));
@$email=mysql_result(mysql_query("SELECT email FROM users WHERE email='$pEmail'"),0);
    if(isset($_POST['surname'])&&isset($_POST['name'])&&isset($_POST['middle_name'])&&isset($_POST['birthday'])&&isset($_POST['sex'])&&isset($_POST['adress'])&&
       isset($_POST['home_index'])&&isset($_POST['tel'])&&isset($_POST['org_name'])&&isset($_POST['podr'])&&isset($_POST['job'])&&isset($_POST['email_form'])&&isset($_POST['password'])&&$email==""){
        $pSurname=htmlspecialchars(mysql_real_escape_string($_POST['surname']));
        $pName=htmlspecialchars(mysql_real_escape_string($_POST['name']));
        $pMiddleName=htmlspecialchars(mysql_real_escape_string($_POST['middle_name']));
        $pBirthday=htmlspecialchars(mysql_real_escape_string($_POST['birthday']));
        $pSex=htmlspecialchars(mysql_real_escape_string($_POST['sex']));
        $pAdress=htmlspecialchars(mysql_real_escape_string($_POST['adress']));
        $pHomeIndex=htmlspecialchars(mysql_real_escape_string($_POST['home_index']));
        $pPhone=htmlspecialchars(mysql_real_escape_string($_POST['tel']));
        $pOrgName=htmlspecialchars(mysql_real_escape_string($_POST['org_name']));
        $pPodr=htmlspecialchars(mysql_real_escape_string($_POST['podr']));
        $pJob=htmlspecialchars(mysql_real_escape_string($_POST['job']));
        $pEmail=htmlspecialchars(mysql_real_escape_string($_POST['email_form']));
        $pPassword=htmlspecialchars(mysql_real_escape_string($_POST['password']));
        
        @$idOrg=mysql_result(mysql_query("SELECT id_org FROM organizations WHERE name='".$pOrgName."'"),0);
        @$idJob=mysql_result(mysql_query("SELECT job_id FROM job WHERE job='".$pJob."'"),0);
        $md5Pass=md5($pPassword);
        $dates=time();
        $lastId=mysql_insert_id();
        $md5Time=md5("time");
        $md5Code=md5($lastId." ".$dates);
        
        if(mysql_query("INSERT INTO users(surname, name, middle_name, date_birth, gender, adress, p_index, phone, id_org, podrazd, job, md5_password, email, check_email, dates, time_id)
        VALUES('$pSurname','$pName','$pMiddleName','$pBirthday','$pSex','$pAdress','$pHomeIndex','$pPhone','$idOrg','$pPodr','$idJob','$md5Pass','$pEmail','N','$dates','$md5Code')")){
            
           setcookie($md5Time,md5($lastId." ".$dates));
            
            print "<script>alert('Вы зарегестрированы');</script>";
        }else{
            print "<script>alert('Произошла какая-то ошибка!');</script>";
        }
    }else{
        print "<script>alert('На один емаил нельзя регистрировать более одного пользователя!');</script>";
    }
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="images/icon.jpg">
    <title>Краевой фонд науки - Регистрация</title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
       <script type="text/javascript" src="../jquery-2.2.3.min.js"></script>
       
    </head>
<body>

 <script type="text/javascript">
        $(document).ready(function() {
            $('#org_name').change(function() {
                //alert("aaa");
                value=$(this).val();
                $.post('block.php', {id:value}, function(data) {
                    //$('#content').html(data);
                   obj=JSON.parse(data);
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
                    $("#phone").attr('value',obj.phone);
                    $("#email").attr('value',obj.email);
                    //alert(obj.inn); // будет выведено "John"
                    //alert("aaa");
                });
            });
        });
    </script>

<div class="wrapper">
	<header>
		<div id="hed_main">
			<a href="http://krai-fond.ru">Краевой фонд науки</a>
			<p id="postHeader">ДУМАЕМ ГЛОБАЛЬНО</p>
		</div>
	</header>

	<nav>
		<div class="menu">
			<a href="index.html" id="menu_1">ГЛАВНАЯ</a>
			<a href="2" id="menu_2">ПОДАТЬ ЗАЯВКУ</a>
			<a href="3" id="menu_3">РЕЕСТР ЗАЯВОК</a>
			<a href="4" id="menu_4">ПОМОЩЬ</a>
		</div>
	</nav>
	
	


<div id="content" class="clearfix">
	<form action="registration.php" method="POST" name="registration">
		<div id="registration_form">
			<div id="block_one">
				<div class="fieldset_1">
				
					<label class="label">Фамилия:
						<p><input type="text" pattern="[А-ЯЁ][а-яё]+$"  name="surname" size="45" maxlength="20" placeholder="Введите фамилию" 
                             required title="Вводите только буквы русского алфавита, начания с заглавной. Максимальная длина: 15 символов."></p>
                    </label>
						     
					<label class="label">Имя:
						<p><input type="text" pattern="[А-ЯЁ][а-яё]+$" name="name" size="45" maxlength="15" placeholder="Введите имя"
						     required title="Вводите только буквы русского алфавита, начания с заглавной. Максимальная длина: 15 символов."></p>
				    </label>
						
					<label class="label">Отчество:
						<p><input type="text" pattern="[А-ЯЁ][а-яё]+$" name="middle_name" size="45" maxlength="20" placeholder="Введите отчество"
						     required title="Вводите только буквы русского алфавита, начания с заглавной. Максимальная длина: 15 символов."></p>
				    </label>
						     
					<label class="label">Дата рождения:
						<p class="post_form">Формат: дд.мм.гггг</p>
						    <p><input type="date" pattern="[0-3][0-9].[0-1][0-9].19[0-9]{2}" name="birthday" size="15" maxlength="10" placeholder="дд.мм.гггг"
						         required title="Выберете дату в календаре. Если календарь не отображается, введите дату в формате 'дд.мм.гггг'."></p>
				    </label>
						 
					<label class="label" for="sex">Пол:</label>
				<p><label>
				    Мужской<input type="radio" name="sex" value="male" checked></label> <label>Женский<input type="radio" name="sex" value="female">
				</label></p>
				
				</div>
				
				<div class="fieldset_2">
				
					<label for="adress" class="label">Адрес:</label>
				    <p class="post_form">Пример: г. Москва, Ломоносовский пр-т, д.31, корп.2, кв.15</p>
					<p><textarea name="adress" cols="45" rows="6" id="adress" placeholder="Введите адрес" required></textarea></p>
						
					<label class="label">Домашний индекс:
						<p><input type="text" pattern="[0-9]{6}" name="home_index" size="25" maxlength="6" placeholder="Введите домашний индекс"
						     required title="Вводите только цифры."></p>
				    </label>
				    
					<label class="label">Номер телефона:
				        <p class="post_form">Формат: (xxx)-xxx-xxxx</p>
				        <p><input type="tel" pattern="[(][0-9]{3}[)]-[0-9]{3}-[0-9]{4}" size="45" maxlength="14" name="tel" placeholder="Введите номер телефона"
				             required title="Введите номер телефона в формате: (ххх)-ххх-хххх"></p>
				    </label>
				    
				</div>
				
				<div class="fieldset_3">
				
					<label class="label">Наименование организации:
                           <p><select id="org_name" style="width:300px;background:#fff;" name="org_name">
                              <?php
                                    for($i=0;$i<$col_string;$i++){
                                        print "<option value='".mysql_result($sName,$i)."' class='reg'>".mysql_result($sName,$i)."</option>";
                                    }
                              ?>
                               </select></p>
				    </label>
				    
					<label class="label">ИНН:\
						<p><input type="text" pattern="[0-9]{10}"  name="inn" size="45" maxlength="10" placeholder="Введите ИНН" title="Вводите только цифры." required id="inn"></p>
				    </label>
				    
					<label class="label">KПП:
						<p><input type="text" pattern="[0-9]{9}"  name="kpp" size="45" maxlength="9" placeholder="Введите KПП" title="Вводите только цифры." required id="kpp"></p>
				    </label>
						
					<label class="label">ОГРН:
						<p><input type="text" pattern="[0-9]{13}"  name="ogrn" size="45" maxlength="13" placeholder="Введите ОГРН" title="Вводите только цифры." required id="ogrn"></p>
				    </label>
						
					<label class="label">ОКПО:
						<p><input type="text" pattern="[0-9]{8}"  name="okpo" size="45" maxlength="8" placeholder="Введите ОКПО" title="Вводите только цифры." required id="okpo"></p>
				    </label>
						
					<label class="label">ОКАТО:
						<p><input type="text" pattern="[0-9]{11}"  name="okato" size="45" maxlength="11" placeholder="Введите ОКАТО" title="Вводите только цифры." required id="okato"></p>
				    </label>
						
					<label class="label">Основной вид экономической деятельности:
						<p><input type="text" pattern="^[А-Яа-яЁё\s]+$"  name="oved" size="45" maxlength="100"
						     placeholder="Введите основной вид экономической деятельности" title="Вводите только буквы русского алфавита." id="oved" required></p>
				    </label>
						
					<label class="label">Юридический адрес:
						<p class="post_form">Пример: г. Москва, Ломоносовский пр-т, д.31, корп.2, кв.15</p>
						<p><input type="text"  name="ur_address" size="45" maxlength="50" placeholder="Введите юридический адрес" required id="ur_adress"></p>
				    </label>
						
					<label class="label">Фактический адрес:
						<p class="post_form">Пример: г. Москва, Ломоносовский пр-т, д.31, корп.2, кв.15</p>
						<p><input type="text" name="f_address" size="45" maxlength="50" placeholder="Введите фактический адрес" required id="f_adress"></p>
				    </label>
						
						
					<label class="label">Адрес для корреспонденции:
						<p class="post_form">Пример: г. Москва, Ломоносовский пр-т, д.31, корп.2, кв.15</p>
						<p><input type="text" name="kor_address" size="45" maxlength="50" placeholder="Введите адрес для корреспонденции" required id="kor_adress"></p>
				    </label>
						
					<label class="label">Факс:
						<p class="post_form">Формат: (xxx)-xxx-xxxx</p>
						<p><input type="tel" pattern="[(][0-9]{3}[)]-[0-9]{3}-[0-9]{4}"  name="fax" size="45" maxlength="14" placeholder="Введите факс" 
                            title="Введите номер факса в формате: (ххх)-ххх-хххх" required id="fax"></p>
				    </label>
				    
					<label class="label">Телефон:
						<p class="post_form">Формат: (xxx)-xxx-xxxx</p>
						<p><input type="tel" pattern="[(][0-9]{3}[)]-[0-9]{3}-[0-9]{4}" size="45" maxlength="14" name="phone" placeholder="Введите номер телефона"
						     title="Введите номер телефона в формате: (ххх)-ххх-хххх" required id="phone"></p>
				    </label>
				    
					<label class="label">Электронный адрес:
						<p><input type="email" name="email" size="45" maxlength="20" placeholder="Введите E-mail" required id="email"></p>
				    </label>
				    
					<label class="label">Подразделение:
						<p><input type="text" pattern="^[А-Яа-яЁё\s]+$"  name="podr" size="45" maxlength="50" placeholder="Введите подразделение"
						     title="Вводите только буквы русского алфавита."></p>
				    </label>
				    
					<label class="label">Должность:
						<p><select placeholder="Введите должность"  style="width:300px;background:#fff;position:relative;bottom:100%;" size="1" name="job">
                                <?php
                                    for($i=0;$i<$colJob;$i++){
                                        print "<option value='".mysql_result($sJob,$i)."'>".mysql_result($sJob,$i)."</option>";
                                    }
                                ?>
                            </select></p>
				    </label>
				    
				</div>
			</div>
				
			<div id="block_two">
				<div class="fieldset_4">
				
					<label class="label">Адрес электронной почты:
						<p><input type="email" name="email_form" size="45" maxlength="20" placeholder="Введите E-mail" required></p>
				    </label>
				    
					<label class="label">Пароль:
						<p><input type="password" name="password" size="45" maxlength="25" placeholder="Введите пароль" required></p>
				    </label>
				    
					<label class="label">Подтверждение пароля:
						<p><input type="password" name="reg_password_2(second)" size="45" maxlength="25" placeholder="Подтведите пароль" required></p>
				    </label>
						
				</div>
				
				<div id="accept">
				
					<label id="soglasie"><input type="checkbox" name="soglasie" required>Согласие на публикацию данных</label>
					<p><input type="submit" name="submit" id="submit" alt="Отправить"></p>
					
				</div>
				
			</div>		
		</div>
	</form>
</div>	
		
		
<footer>
	<div id="text_footer">
		<p>Краевое государственное автономное учреждение</p>
		<p>"Красноясркий краевой фонд поддержеи научной и научно-технической деятльности"</p>
	</div>
</footer>
		
</div>
</body></html>