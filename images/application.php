<?php
header('Content-Type: text/html; charset=cp-1251');
$db = mysql_connect("localhost", "root", "slipknot");
mysql_select_db("good_mark");

if($_GET['id']==''){
    $sAllApplication=mysql_query("SELECT * FROM applications");
    $arrayApplications=mysql_fetch_assoc($sAllApplication);
    $colApplications=mysql_num_rows($sAllApplication);
    print "<table border=1><tr>
            <td>�����</td>
            <td>�������� ��������</td>
            <td>���� ������</td>
            <td>���� ���������</td></tr>";
    for($i=0;$i<$colApplications;$i++){
        print "<tr><td>".$arrayApplications['id']."</td>
            <td><a href='application.php?id=".$arrayApplications['id']."'>".$arrayApplications['name']."</a></td>
            <td>".$arrayApplications['date_begin']."</td>
            <td>".$arrayApplications['date_end']."</td></tr>";
    }    
    print "</table>";
}elseif($_GET['id']!='' && $_GET['do']==''){
    $getAppId=htmlspecialchars(mysql_real_escape_string($_GET['id']));
    $sApp=mysql_query("SELECT * FROM applications WHERE id='$getAppId'");
    $arrApp=mysql_fetch_assoc($sApp);
    print "<h2>".$arrApp['name']."</h2>
    <p>".$arrApp['value']."</p>
    <p>���� ������: <b>".$arrApp['date_begin']."</b></p>
    <p>���� ������: <b>".$arrApp['date_end']."</b></p>
    <h3><a href='application.php?id=".$getAppId."&do=app'>��������� ������</a></h3>";
    
}elseif($_GET['id']!='' && $_GET['do']=='app'){
    $getAppId=htmlspecialchars(mysql_real_escape_string($_GET['id']));
    $getUserId=htmlspecialchars(mysql_real_escape_string($_GET['us_id']));
    if(mysql_result(mysql_query("SELECT user_id FROM accepted WHERE user_id='$getUserId' AND con_id='$getAppId'"),0)==""){
        if(sizeof($_POST)>0){
            foreach($_POST as $key => $value){

                $val=mysql_real_escape_string(htmlspecialchars($value, ENT_COMPAT, 'cp1251'));
                $arrKey=explode('_',$key);
                $tableId=$arrKey[0];
                $stringId=$arrKey[1];
                print $tableId."---".$stringId."---".$val;
                mysql_query("INSERT INTO request(table_id, string_id, value, user_id) VALUES('$tableId','$stringId','$val','$getUserId')");
            }
            $dates=time();
            $org_id=mysql_result(mysql_query("SELECT id_org FROM users WHERE user_id='$getUserId'"),0);
            mysql_query("INSERT INTO accepted(user_id, con_id, accepted, dates, org_id) VALUES('$getUserId','$getAppId','n','$dates','$org_id')");

        }
        $sApplication=mysql_query("SELECT table_id FROM app_id WHERE app_id='$getAppId'");
        $colTables=mysql_num_rows($sApplication);
        print "<form action='application.php?id=".$getAppId."&do=app&us_id=2' method='POST'>";
        for($i=0;$i<$colTables;$i++){
            $tableId=mysql_result($sApplication,$i);
            print "<h3 style='color:green;'>".mysql_result(mysql_query("SELECT name FROM tables WHERE id='$tableId'"),0)."</h3>";
            $sAllString=mysql_query("SELECT string_id FROM table_id WHERE table_id='$tableId'");
            $colString=mysql_num_rows($sAllString);
            for($j=0;$j<$colString;$j++){
                $stringId=mysql_result($sAllString,$j);
                $stringName=mysql_result(mysql_query("SELECT name FROM string WHERE id='$stringId'"),0);
                print "<b>".$stringName."</b><br>
                <textarea name='".$tableId."_".$stringId."'></textarea><br>";

            }
        }
        print "<input type='submit'></form> ";
    }else{
        print "<script>alert('�� �� ������ ��������� �� ���� ������� ����� ����� ������!');</script>";
    }
    
}

?>