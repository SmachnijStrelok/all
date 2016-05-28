<?php
    $db = mysql_connect("localhost", "root", "slipknot");
    mysql_select_db("good_mark");
    mysql_query("SET CHARSET windows-1251");
    $sName=mysql_query("SELECT name FROM organizations");
    $sJob=mysql_query("SELECT job FROM job");
    $col_string=mysql_num_rows($sName);
    $colJob=mysql_num_rows($sJob);
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
	<form action="formdata.php" method="POST" name="registration">
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
						<p><input type="text" pattern="[А-ЯЁ][а-яё]+$" name="otchestvo" size="45" maxlength="20" placeholder="Введите отчество"
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
				
					<label for="address" class="label">Адрес:</label>
				    <p class="post_form">Пример: г. Москва, Ломоносовский пр-т, д.31, корп.2, кв.15</p>
					<p><textarea name="address" cols="45" rows="6" id="address" placeholder="Введите адрес" required></textarea></p>
						
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
                           <p><select id="org_name" style="width:300px;background:#fff;">
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
						<p><select placeholder="Введите должность">
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
						<p><input type="password" name="reg_password_2(first)" size="45" maxlength="25" placeholder="Введите пароль" required></p>
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
</body>
</html>
