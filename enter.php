<?php
    $db = mysql_connect("localhost", "root", "slipknot");
    mysql_select_db("good_mark");
    mysql_query("SET CHARSET windows-1251");
    $md5Time=md5("time");
    $enter=0;
    function printUserInformation($userId){
        $sInformation=mysql_query("SELECT * FROM users WHERE user_id='$userId'");
        $arrInformation=mysql_fetch_assoc($sInformation);
        $jobId=$arrInformation['job'];
        $job=mysql_result(mysql_query("SELECT job FROM job WHERE job_id='$jobId'"),0);
        if($arrInformation['gender']=='male'){
            $sex='Мужской';
        }else{
            $sex='Женский';
        }
        print "Фамилия:<br>"
            .$arrInformation['surname'].
            "<br>Имя:<br>"
            .$arrInformation['name'].
            "<br>Отчество:<br>"
            .$arrInformation['middle_name'].
            "<br>Дата Рождения:<br>"
            .$arrInformation['date_birth'].
            "<br>Пол:<br>"
            .$sex.
            "<br>Домашний адрес:<br>"
            .$arrInformation['adress'].
            "<br>Домашний индекс:<br>"
            .$arrInformation['p_index'].
            "<br>Подразделение:<br>"
            .$arrInformation['podrazd'].
            "<br>Должность:<br>"
            .$job.
            "<br>Электронный адрес:<br>"
            .$arrInformation['email'].
            "<br>Контактный телефон:<br>"
            .$arrInformation['phone'].
            "<br>Дата регистрации:<br>"
            .$arrInformation['dates'];
    }
    
    function printOrgInformation($orgId){
        $sInformation=mysql_query("SELECT * FROM organizations WHERE id_org='$orgId'");
        $arrInformation=mysql_fetch_assoc($sInformation);
        
        print "Название организации:<br>"
            .$arrInformation['name'].
            "<br><br>ИНН:<br>"
            .$arrInformation['inn'].
            "<br><br>КПП:<br>"
            .$arrInformation['kpp'].
            "<br><br>ОГРН:<br>"
            .$arrInformation['ogrn'].
            "<br><br>ОКПО:<br>"
            .$arrInformation['okpo'].
            "<br><br>ОКАТО:<br>"
            .$arrInformation['okato'].
            "<br><br>Основной вид экономической деятельности:<br>"
            .$arrInformation['oved'].
            "<br><br>Юридический адрес:<br>"
            .$arrInformation['ur_adress'].
            "<br><br>Фактический адрес:<br>"
            .$arrInformation['f_adress'].
            "<br><br>Адрес для корреспонденции:<br>"
            .$arrInformation['kor_adress'].
            "<br><br>Факс:<br>"
            .$arrInformation['fax'].
            "<br><br>Телефон:<br>"
            .$arrInformation['phone'].
            "<br><br>Электронный адрес:<br>"
            .$arrInformation['email'];
        
    }

    if(isset($_POST["email"])&&isset($_POST["password"])){
        $pEmail=htmlspecialchars(mysql_real_escape_string($_POST["email"]));
        $pPassword=md5(htmlspecialchars(mysql_real_escape_string($_POST["password"])));
        $checkEmail=mysql_num_rows(mysql_result(mysql_query("SELECT user_id FROM users WHERE email='$pEmail'"),0));
        $checkPassword=mysql_result(mysql_query("SELECT user_id FROM users WHERE md5_password='$pPassword'"),0);
        if($checkEmail!=""&&$checkPassword!=""){
            printUserInformation($checkPassword);
            $idOrg=mysql_query("SELECT id_org FROM users WHERE email='$pEmail'");
            printOrgInformation($idOrg);
            //выводим данные о пользователе
        }else
            print "Ошибка, неверные данные!";

    }elseif($_COOKIE[$md5Time]!=""){
        $timeId=htmlspecialchars(mysql_real_escape_string($_COOKIE[$md5Time]));
        //print '---'.$timeId.'---';
        $checkCookie=mysql_result(mysql_query("SELECT user_id FROM users WHERE time_id='$timeId'"),0);
        if($checkCookie!=""){
            
            if(@$_GET['a']==''){
                
                printUserInformation($checkCookie);
                $idOrg=mysql_result(mysql_query("SELECT id_org FROM users WHERE user_id='$checkCookie'"),0);
                printOrgInformation($idOrg);
                
                }elseif($_GET['a']=='update'){
                
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
                    
                
                    $userId=$checkCookie;
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
                    print "<form action='enter.php?a=update' method='POST'>Фамилия:<br>
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
            
            
            
            
            
            
        }else
            print "Чет с куками у вас какая-то муть!";
        
    }
?>