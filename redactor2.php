<?php
header('Content-Type: text/html; charset=utf-8');
$db = mysql_connect("localhost", "root", "slipknot");
mysql_select_db("good_mark");?>
<html><head>
<script type="text/javascript" src="jquery-2.2.3.min.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $("#tables").change(function() {
                value=$(this).val();
                alert(value);
                $.post('block.php', {table_id:value}, function(data) {
                    //$('#content').html(data);
                    alert(data);
                   obj=JSON.parse(data);
                    //obj = jQuery.parseJSON("data":"abc","reg":"aaa");
                    //alert(obj[9]);
                    //$("#strings>option").remove();
                    //for(var keyss in obj){
                        //$("#strings").append("<option value='"+keys+"'>"+value+"</option>");
                        //alert("---"+keyss+"---"+obj[keyss]);
                    //}
                    //alert(value);
                    //$("#email").attr('value',obj.email);
                    //alert(obj.inn); // ����� �������� "John"
                    //alert("aaa");
                });
            });
        });
    </script></head><body>
<?php
function printUserInformation($userId){
        $sInformation=mysql_query("SELECT * FROM users WHERE user_id='$userId'");
        $arrInformation=mysql_fetch_assoc($sInformation);
        $jobId=$arrInformation['job'];
        $job=mysql_result(mysql_query("SELECT job FROM job WHERE job_id='$jobId'"),0);
        if($arrInformation['gender']=='male'){
            $sex='�������';
        }else{
            $sex='�������';
        }
        print "�������:<br>"
            .$arrInformation['surname'].
            "<br>���:<br>"
            .$arrInformation['name'].
            "<br>��������:<br>"
            .$arrInformation['middle_name'].
            "<br>���� ��������:<br>"
            .$arrInformation['date_birth'].
            "<br>���:<br>"
            .$sex.
            "<br>�������� �����:<br>"
            .$arrInformation['adress'].
            "<br>�������� ������:<br>"
            .$arrInformation['p_index'].
            "<br>�������������:<br>"
            .$arrInformation['podrazd'].
            "<br>���������:<br>"
            .$job.
            "<br>����������� �����:<br>"
            .$arrInformation['email'].
            "<br>���������� �������:<br>"
            .$arrInformation['phone'].
            "<br>���� �����������:<br>"
            .$arrInformation['dates'];
    }
    
    function printOrgInformation($orgId){
        $sInformation=mysql_query("SELECT * FROM organizations WHERE id_org='$orgId'");
        $arrInformation=mysql_fetch_assoc($sInformation);
        
        print "�������� �����������:<br>"
            .$arrInformation['name'].
            "<br><br>���:<br>"
            .$arrInformation['inn'].
            "<br><br>���:<br>"
            .$arrInformation['kpp'].
            "<br><br>����:<br>"
            .$arrInformation['ogrn'].
            "<br><br>����:<br>"
            .$arrInformation['okpo'].
            "<br><br>�����:<br>"
            .$arrInformation['okato'].
            "<br><br>�������� ��� ������������� ������������:<br>"
            .$arrInformation['oved'].
            "<br><br>����������� �����:<br>"
            .$arrInformation['ur_adress'].
            "<br><br>����������� �����:<br>"
            .$arrInformation['f_adress'].
            "<br><br>����� ��� ���������������:<br>"
            .$arrInformation['kor_adress'].
            "<br><br>����:<br>"
            .$arrInformation['fax'].
            "<br><br>�������:<br>"
            .$arrInformation['phone'].
            "<br><br>����������� �����:<br>"
            .$arrInformation['email'];
        
    }








if($_GET['id']=='' && $_GET['user']=='' && $_GET['a']==''){
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
            <td><a href='redactor.php?id=".$arrayApplications['id']."'>".$arrayApplications['name']."</a></td>
            <td>".$arrayApplications['date_begin']."</td>
            <td>".$arrayApplications['date_end']."</td></tr>";
    }    
    print "</table>";
}elseif($_GET['id']!='' && $_GET['user']=='' && $_GET['a']==''){
    $checkId=htmlspecialchars(mysql_real_escape_string($_GET['id']));
    
    
    
     print "<form action='redactor.php?id=".$checkId."' method='POST'>
<input type='radio' name='selection' value='all' /> ���
<input type='radio' name='selection' value='y' /> ��������
<input type='radio' name='selection' value='n' /> �� �������� <input type='submit' value='�����������'></form>
     <table border=1><tr>
    <td>��������</td>
    <td>������������</td>
    <td>�����������</td>
    <td>���� ������</td>
    <td>���������</td></tr>";
    if($_POST['selection']=='' || $_POST['selection']=='all'){
        $sApp=mysql_query("SELECT * FROM accepted WHERE con_id='$checkId'");
        $colApp=mysql_num_rows(mysql_query("SELECT id FROM accepted WHERE con_id='$checkId'"));
        //$arrApp=mysql_fetch_assoc($sApp);
        for($i=0;$i<$colApp;$i++){
            $arrApp=mysql_fetch_assoc($sApp);
            $aOrg=$arrApp['org_id'];
            $org=mysql_result(mysql_query("SELECT name FROM organizations WHERE id_org='$aOrg'"),0);
            print "<tr><td><a href='redactor.php?id=".$checkId."&user=".$arrApp['user_id']."'>��������</a></td>
                <td>".$arrApp['user_id']."</td>
                <td>".$org."</td>
                <td>".$arrApp['dates']."</td>
                <td>".$arrApp['accepted']."</td></tr>";
        }
    }elseif($_POST['selection']=='y'){
        $sApp=mysql_query("SELECT * FROM accepted WHERE con_id='$checkId' AND accepted='y'");
        $colApp=mysql_num_rows(mysql_query("SELECT id FROM accepted WHERE con_id='$checkId' AND accepted='y'"));
        //$arrApp=mysql_fetch_assoc($sApp);
        for($i=0;$i<$colApp;$i++){
            $arrApp=mysql_fetch_assoc($sApp);
            $aOrg=$arrApp['org_id'];
            $org=mysql_result(mysql_query("SELECT name FROM organizations WHERE id_org='$aOrg'"),0);
            print "<tr><td><a href='redactor.php?id=".$checkId."&user=".$arrApp['user_id']."'>��������</a></td>
                <td>".$arrApp['user_id']."</td>
                <td>".$org."</td>
                <td>".$arrApp['dates']."</td>
                <td>".$arrApp['accepted']."</td></tr>";
        }
    }elseif($_POST['selection']=='n'){
        $sApp=mysql_query("SELECT * FROM accepted WHERE con_id='$checkId' AND accepted='n'");
        $colApp=mysql_num_rows(mysql_query("SELECT id FROM accepted WHERE con_id='$checkId' AND accepted='n'"));
        //$arrApp=mysql_fetch_assoc($sApp);
        for($i=0;$i<$colApp;$i++){
            $arrApp=mysql_fetch_assoc($sApp);
            $aOrg=$arrApp['org_id'];
            $org=mysql_result(mysql_query("SELECT name FROM organizations WHERE id_org='$aOrg'"),0);
            print "<tr><td><a href='redactor.php?id=".$checkId."&user=".$arrApp['user_id']."'>��������</a></td>
                <td>".$arrApp['user_id']."</td>
                <td>".$org."</td>
                <td>".$arrApp['dates']."</td>
                <td>".$arrApp['accepted']."</td></tr>";
        }
    }
}elseif($_GET['id']!='' && $_GET['user']!='' && $_GET['a']==''){
    $checkId=htmlspecialchars(mysql_real_escape_string($_GET['id']));
    $checkUser=htmlspecialchars(mysql_real_escape_string($_GET['user']));
    //print_r($_POST);
    $array=array();
    $val='';
    foreach($_POST as $key=>$value) {
        //$key = $value;
        //$val=htmlspecialchars(mysql_real_escape_string($_POST[$key]));
        if($key=='accept' && $value=='yes'){
            mysql_query("UPDATE accepted SET accepted='y' WHERE con_id='$checkId' AND user_id='$checkUser'");
        }
        $x=mysql_real_escape_string(htmlspecialchars($value, ENT_COMPAT, 'cp1251'));
        //print "+++".$key."---".$x;
        mysql_query("UPDATE request SET value='$x' WHERE id='$key'");
    }
    $orgId=mysql_result(mysql_query("SELECT org_id FROM accepted WHERE user_id='$checkUser' AND con_id='$checkId'"),0);
    //print "<script>alert('".$orgId."---".$checkId."---".$checkUser."');</script>";
    print "<table border=1><tr><td>";
    printUserInformation($checkUser);
    print "</td><td>";
    printOrgInformation($orgId);
    print "</td></tr></table>";
    
    $sTables=mysql_query("SELECT table_id FROM app_id WHERE app_id='$checkId'");//�������� � ������� � �������� ������ ������� ���� � ������ ��������
    $colTables=mysql_num_rows($sTables);
    print "<form action='redactor.php?id=".$checkId."&user=".$checkUser."' method='POST'>";
    for( $i = 0; $i < $colTables; $i ++ ){
        
        $idTable=mysql_result($sTables,$i);
        $nameTable=mysql_result(mysql_query("SELECT name FROM tables WHERE id='$idTable'"),0);
        $sStringId=mysql_query("SELECT string_id FROM table_id WHERE table_id='$idTable'");
        $colString=mysql_num_rows($sStringId);
        print "<h3>".$nameTable."</h3>";
        
        for( $j = 0 ; $j < $colString ; $j ++ ){
            
            $idString=mysql_result($sStringId,$j);//������������� ������
            $id=mysql_result(mysql_query("SELECT id FROM request WHERE table_id='$idTable' AND string_id='$idString' AND user_id='$checkUser'"),0);
            $nameString=mysql_result(mysql_query("SELECT name FROM string WHERE id='$idString'"),0);//�������� �������� ������
            $userValue=mysql_result(mysql_query("SELECT value FROM request WHERE string_id='$idString' AND user_id='$checkUser'"),0);//�������� �������� ��������� �������������
            print "<b>".$nameString.":</b><br><textarea name='".$idString."' cols=40 rows=4>".$userValue."</textarea><br>";
        }
    }
    print "<input type='checkbox' name='accept' value='yes'> ������� ������<br><input type='submit'></form>";
    
    

}elseif($_GET['a']=='newapp'){
    $sTableName=mysql_query("SELECT id, name FROM tables");
    $colTables=mysql_num_rows($sTableName);
    print "<table border=1><tr><td>�������� ��������<textarea name='name'></textarea></td></tr>
            <tr><td>�������� ��������<textarea name='name'></textarea></td></tr>
            <tr><td>���� ������:<input type='text' name='date_begin'></td><td>���� �����:<input type='text' name='date_begin'></td></tr>
            <tr><td>��������� <select name='visible'><option value='y'>�����</option><option value='y'>�� �����</option></select></td><td><select name='tables' size=1 id='tables'>";
    for($i=0;$i<$colTables;$i++){
        $arrTables=mysql_fetch_assoc($sTableName);
        print "<option value='".$arrTables['id']."'>".$arrTables['name']."</option>";
    }
    print "</select><select name='strings'><option value='1'>1</option></select></td></tr></table>";
}


















    ?></body></html>