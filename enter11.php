<?php
error_reporting (0);
class Enter{
    
    
       public function printUserInformation( $userId ) {//распечатываем всю инфу о пользователе по ID пользователя
            
                $sInformation = mysql_query("SELECT * FROM users WHERE user_id='$userId'");
                $arrInformation = mysql_fetch_assoc( $sInformation );
                $jobId = $arrInformation['job'];
                $job = mysql_result(mysql_query("SELECT job FROM job WHERE job_id='$jobId'"), 0);
                if( $arrInformation['gender'] == 'male' ){
                    $sex='Мужской';
                }else{
                    $sex='Женский';
                }
                print "<p class='label enter-label'>фамилия:</p>"
                    .$arrInformation['surname'].
                    "<p class='label enter-label'>Имя:</p>"
                    .$arrInformation['name'].
                    "<p class='label enter-label'>Отчество:</p>"
                    .$arrInformation['middle_name'].
                    "<p class='label enter-label'>Дата Рождения:</p>"
                    .$arrInformation['date_birth'].
                    "<p class='label enter-label'>Пол:</p>"
                    .$sex.
                    "<p class='label enter-label'>Домашний адрес:</p>"
                    .$arrInformation['adress'].
                    "<p class='label enter-label'>Домашний индекс:</p>"
                    .$arrInformation['p_index'].
                    "<p class='label enter-label'>Подразделение:</p>"
                    .$arrInformation['podrazd'].
                    "<p class='label enter-label'>Должность:</p>"
                    .$job.
                    "<p class='label enter-label'>Электронный адрес:</p>"
                    .$arrInformation['email'].
                    "<p class='label enter-label'>Контактный телефон:</p>"
                    .$arrInformation['phone'].
                    "<p class='label enter-label'>Дата регистрации:</p>"
                    .$arrInformation['dates'];

        }
            
       public function printOrgInformation($orgId){//распечатываем всю инфу об организации по ID организации

            $sInformation=mysql_query("SELECT * FROM organizations WHERE id_org='$orgId'");
            $arrInformation=mysql_fetch_assoc($sInformation);

            print "<p class='label enter-label'>Название организации:</p>"
                .$arrInformation['name'].
                "<p class='label enter-label'>ИНН:</p>"
                .$arrInformation['inn'].
                "<p class='label enter-label'>КПП:</p>"
                .$arrInformation['kpp'].
                "<p class='label enter-label'>ОГРН:</p>"
                .$arrInformation['ogrn'].
                "<p class='label enter-label'>ОКПО:</p>"
                .$arrInformation['okpo'].
                "<p class='label enter-label'>ОКАТО:</p>"
                .$arrInformation['okato'].
                "<p class='label enter-label'>Основной вид экономической деятельности:</p>"
                .$arrInformation['oved'].
                "<p class='label enter-label'>Юридический адрес:</p>"
                .$arrInformation['ur_adress'].
                "<p class='label enter-label'>Фактический адрес:</p>"
                .$arrInformation['f_adress'].
                "<p class='label enter-label'>Адрес для корреспонденции:</p>"
                .$arrInformation['kor_adress'].
                "<p class='label enter-label'>Факс:</p>"
                .$arrInformation['fax'].
                "<p class='label enter-label'>Телефон:</p>"
                .$arrInformation['phone'].
                "<p class='label enter-label'>Электронный адрес:</p>"
                .$arrInformation['email'];
        
        }
    
    
    public function connect($host, $user, $pass, $db){//подключение к БД
        mysql_connect($host, $user, $pass);
        mysql_select_db($db);
        mysql_query("SET CHARSET utf-8");
    }
    
    public function checkUser(){//проверка авторизации пользователя, в случае успеха возвращает 1
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
    
    public function updateInfo($checkCookie){//проверка и обновление данных пользователя
                        
                if(isset($_POST['surname']) && strlen($_POST['surname']) > 0){
                    
                    $checkSurname=htmlspecialchars(mysql_real_escape_string($_POST['surname']));
                    mysql_query("UPDATE users SET surname='$checkSurname' WHERE user_id='$checkCookie'");
                    
                }
                if(isset($_POST['name']) && strlen($_POST['name']) > 0){
                    
                    $checkName=htmlspecialchars(mysql_real_escape_string($_POST['name']));
                    mysql_query("UPDATE users SET name='$checkName' WHERE user_id='$checkCookie'");
                    
                }
                if(isset($_POST['middle_name']) && strlen($_POST['middle_name']) > 0){
                    
                    $checkMiddleName=htmlspecialchars(mysql_real_escape_string($_POST['middle_name']));
                    mysql_query("UPDATE users SET middle_name='$checkMiddleName' WHERE user_id='$checkCookie'");
                    
                }
                if(isset($_POST['date_birth']) && strlen($_POST['date_birth']) > 0){
                    
                    $checkDateBirth=htmlspecialchars(mysql_real_escape_string($_POST['date_birth']));
                    mysql_query("UPDATE users SET date_birth='$checkDateBirth' WHERE user_id='$checkCookie'");
                    
                }
                if(isset($_POST['adress']) && strlen($_POST['adress']) > 0){
                    
                    $checkAdress=htmlspecialchars(mysql_real_escape_string($_POST['adress']));
                    mysql_query("UPDATE users SET adress='$checkAdress' WHERE user_id='$checkCookie'");
                    
                }
                if(isset($_POST['p_index']) && strlen($_POST['p_index']) > 0){
                    
                    $checkIndex=htmlspecialchars(mysql_real_escape_string($_POST['p_index']));
                    mysql_query("UPDATE users SET p_index='$checkIndex' WHERE user_id='$checkCookie'");
                    
                }
                if(isset($_POST['podrazd']) && strlen($_POST['podrazd']) > 0){
                    
                    $checkPodrazd=htmlspecialchars(mysql_real_escape_string($_POST['podrazd']));
                    mysql_query("UPDATE users SET podrazd='$checkPodrazd' WHERE user_id='$checkCookie'");
                    
                }
                if(isset($_POST['email']) && strlen($_POST['email']) > 0){
                    
                    $checkEmail=htmlspecialchars(mysql_real_escape_string($_POST['email']));
                    mysql_query("UPDATE users SET email='$checkEmail' WHERE user_id='$checkCookie'");
                    
                }
                if(isset($_POST['phone']) && strlen($_POST['phone']) > 0){
                    
                    $checkPhone=htmlspecialchars(mysql_real_escape_string($_POST['phone']));
                    mysql_query("UPDATE users SET phone='$checkPhone' WHERE user_id='$checkCookie'");
                }
                if(isset($_POST['job']) && strlen($_POST['job']) > 0){
                    
                    $checkJob=htmlspecialchars(mysql_real_escape_string($_POST['job']));
                    mysql_query("UPDATE users SET job='$checkJob' WHERE user_id='$checkCookie'");
                }
                    
                
                    $userId=$checkCookie;//ID пользователя
                    $sInformation=mysql_query("SELECT * FROM users WHERE user_id='$userId'");
                    $arrInformation=mysql_fetch_assoc($sInformation);
                    $jobId=$arrInformation['job'];
                    $job=mysql_result(mysql_query("SELECT job FROM job WHERE job_id='$jobId'"),0);
                
                    if($arrInformation['gender']=='male')
                        $sex='Мужской';
                    else
                        $sex='Женский';
                    $sJob=mysql_query("SELECT job FROM job");
                    $colJob=mysql_num_rows($sJob);
                    print "<form action='enter1.php?c=update' method='POST'>Фамилия:<br>
                        <input type='text' value='".$arrInformation['surname']."' name='surname'>
                        <br>Имя:<br>
                        <input type='text' value='".$arrInformation['name']."' name='name'>
                        <br>Отчество:<br>
                        <input type='text' value='".$arrInformation['middle_name']."' name='middle_name'>
                        <br>Дата Рождения:<br>
                        <input type='text' value='".$arrInformation['date_birth']."' name='date_birth'>
                        <br>Домашний адрес:<br>
                        <input type='text' value='".$arrInformation['adress']."' name='adress'>
                        <br>Домашний индекс:<br>
                        <input type='text' value='".$arrInformation['p_index']."' name='p_index'>
                        <br>Подразделение:<br>
                        <input type='text' value='".$arrInformation['podrazd']."' name='podrazd'>
                        <br>Должность:<br>
                        <select placeholder='Введите должность'  style='width:300px;background:#fff;position:relative;bottom:100%;' size='1' name='job'>";
                                    for($i=0;$i<$colJob;$i++){
                                        $k=$i+1;
                                        print "<option value='".$k."'>".mysql_result($sJob,$i)."</option>";
                                    }
                            print"</select>
                        <br>Электронный адрес:<br>
                        <input type='text' value='".$arrInformation['email']."' name='email'>
                        <br>Контактный телефон:<br>
                        <input type='text' value='".$arrInformation['phone']."' name='phone'>
                        <br>Дата регистрации:<br>
                        <input type='text' value='".$arrInformation['dates']."' name='dates'>
                        <input type='submit' value='отправить'></form>";
    }
    
    public function printAllRequest($userId){//поданные завявки на все конкурсы, вытаскиваем с БД по ID пользователя
        $sAllApp=mysql_query("SELECT * FROM accepted WHERE user_id='$userId'");
        $colApp=mysql_num_rows($sAllApp);
        print "<table border=1><tr>
            <td><span class='title'>Название конкурса</span></td>
            <td><span class='title'>Дата подачи</span></td>
            <td><span class='title'>Состояние</span></td>
            <td><span class='title'>Редактирование</span></td></tr>";
        for($i=0;$i<$colApp;$i++){
            $arrApp=mysql_fetch_assoc($sAllApp);
            $sApplication=mysql_query("SELECT name FROM applications WHERE id='".$arrApp['con_id']."'");
            
            
            if($arrApp['accepted']=='n'){
                $link="<a href='enter1.php?c=request&id=".$arrApp['con_id']."'>Редактировать</a>";
                $arrApp['accepted']='Не просмотрена';
            }elseif($arrApp['accepted']=='y'){
                $link="<span class='info_table' style='color:#999;'>Редактировать</span>";
                $arrApp['accepted']='Принята';
            }elseif($arrApp['accepted']=='d'){
                $link="<span class='info_table' style='color:#999;'>Редактировать</span>";
                $arrApp['accepted']='Отклонена';
            }
        print "<tr><td><span class='info_table'>".mysql_result($sApplication,0)."</span></td>
            <td><span class='info_table'>".$arrApp['dates']."</a></td>
            <td><span class='info_table'>".$arrApp['accepted']."</span></td>
            <td><span class='info_table'>".$link."</span></td></tr>";    
    
        
        
    }
        print "</table>";
}
    
    public function UserRequest($checkId, $checkUser){//распечатка конкретной заявки
            
        
        foreach($_POST as $key=>$value) {
            $x=mysql_real_escape_string(htmlspecialchars($value));
            mysql_query("UPDATE request SET value='$x' WHERE string_id='$key'");
        }
        
            $sTables=mysql_query("SELECT table_id FROM app_id WHERE app_id='$checkId'");//получаем Н записей с номерами таблиц которые есть в данном конкурсе
            $colTables=mysql_num_rows($sTables);
            print "<form action='enter1.php?c=request&id=".$checkId."' method='POST'>";
            for( $i = 0; $i < $colTables; $i ++ ){

                $idTable=mysql_result($sTables,$i);
                $nameTable=mysql_result(mysql_query("SELECT name FROM tables WHERE id='$idTable'"),0);
                $sStringId=mysql_query("SELECT string_id FROM table_id WHERE table_id='$idTable'");
                $colString=mysql_num_rows($sStringId);
                print "<p class='table_name'>".$nameTable."</p>";

                for( $j = 0 ; $j < $colString ; $j ++ ){

                    $idString=mysql_result($sStringId,$j);//идентификатор строки
                    $id=mysql_result(mysql_query("SELECT id FROM request WHERE table_id='$idTable' AND string_id='$idString' AND user_id='$checkUser'"),0);
                    $nameString=mysql_result(mysql_query("SELECT name FROM string WHERE id='$idString'"),0);//получаем название строки
                    $userValue=mysql_result(mysql_query("SELECT value FROM request WHERE string_id='$idString' AND user_id='$checkUser'"),0);//получаем значение введенное пользователем
                    print "<p class='opis'>".$nameString.":</p><br><textarea name='".$idString."' cols=40 rows=4>".$userValue."</textarea><br>";
                }
            }
        print "<input type='submit'></form><form action='print.php' method='POST'><input type='hidden' name='user_id' value='".$checkUser."'>
        <input type='hidden' name='app_id' value='".$checkId."'><br><input type='submit' value='Версия для печати'></form>";
        
            
        }
    
    }

$enter=new Enter();
$enter->connect('localhost','root','slipknot','good_mark');
$userKey=$_COOKIE['timekey'];
$userId=mysql_result(mysql_query("SELECT user_id FROM users WHERE time_id='$userKey'"),0);
$check=$enter->checkUser();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="images/icon.jpg">
<title>Краевой фонд науки</title>
<link href="css/style.css" type="text/css" rel="stylesheet">
<link href="css/er.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="jquery-2.2.3.min.js"></script>
</head>
<body>
<div class="wrapper">

<header>

	<div id="hed_main">
		<a href="index.html"><span id="hed_title">Краевой фонд науки</span></a>
	</div>
	<span id="post_header">ДУМАЕМ ГЛОБАЛЬНО</span>
	
	
	<div class="reg_log_panel">
		<a href="reg1.php" id="reg_pop">Регистрация</a>
		<a href="#login_form" id="login_pop">Войти</a>
	</div>
	
	<a href="#x" class="reg_log_overlay" id="login_form"></a>
	
	<div class="reg_log_popup bgcolor">
	
				<a href="#close" class="reg_log_close"></a>

				<span id="reg_log_popup-title">Авторизация</span>
				
        <form action='enter1.php' method='POST'>
				<span class="input input_email">
				
					<input type="email" name="email" maxlength="40" class="input_field" id="input-1">
					
					<label class="input_label" for="input-1">
						<span class="input_label-content input_label-content-2">E-mail</span>
					</label>
					
				</span>
				
				<span class="input input_password">"email"email "email
				
					<input type="password" name="password" maxlength="40" class="input_field" id="input-2">
					
					<label class="input_label" for="input-2">
						<span class="input_label-content input_label-content-2">Пароль</span>
					</label>
					
				</span>
        
				<input type="submit" value="Войти" class="btn_popup_login">
        </form>
				
				<a href="#" class="forgot_password">забыли пароль?</a>

	</div>
	
</header>
<?php
  if($check==1){//в зависимости от того вошел ли пользователь печатаем разные меню
      print '<nav>
	<div class="main_menu">
		<a href="enter1.php" class="main_menu_buttons" id="page_lk">Личный кабинет</a>
		<a href="enter1.php?c=update" class="main_menu_buttons" id="page_update">Редактирование профиля</a>
        <a href="enter1.php?c=request" class="main_menu_buttons" id="page_request">Просмотр заявок</a>
        <a href="application.php" class="main_menu_buttons">Подача заявки</a>
	</div>
</nav>';
  }else{
      print '<nav>
	<div class="main_menu">
		<a href="enter.html" class="main_menu_buttons">Личный кабинет</a>
		<a href="texpanel.html" class="main_menu_buttons">Администратор</a>
	</div>
</nav>';
  }   
?>

<script>
$(document).ready(function() {//определяем на какой странице пользователь сейчас находится и подсвечиваем ее
   // alert('a');
    function getUrlVars()
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
        //actions=getUrlVars()['a'];
        //alert(category+'--'+actions);
    if(category==undefined){
        $("#page_lk").attr('class','main_menu_buttons main_menu_current_page');
    }else if(category=='update'){
        $("#page_update").attr('class','main_menu_buttons main_menu_current_page');
    }else if(category=='request'){
        $("#page_request").attr('class','main_menu_buttons main_menu_current_page');
    }
});
</script>
<div class="content">

	<div class="content_2">
	
		<div class="content_box_1">
<?php
            $cid=$_GET['id'];
if($check==1){//если пользователь вошел
    $orgId=mysql_result(mysql_query("SELECT id_org FROM users WHERE user_id='$userId'"),0);//печать данных о нем и организации
    if($_GET['c']==''){//печать данных о юзере и организации
        print "<table><tr><td style='width:300px;'>";
        $enter->printUserInformation($userId);
        print "</td><td style='width:300px;>";
        $enter->printOrgInformation($orgId);
        print "</td></tr></table>";
    }elseif($_GET['c']=='update'){//страница обновления данных
        $enter->updateInfo($userId);
    }elseif($_GET['c']=='request' AND $_GET['id']==''){//просмотр всех заявок
        $enter->printAllRequest($userId);
        //print $userId;
    }elseif($_GET['c']=='request' AND $_GET['id']!=''){//редактирование заявки
        $enter->UserRequest($cid, $userId);
    }
}else{
        print "Ты вошел не туда!";
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
