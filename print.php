<html>
  <script>
      window.print();
    </script>
   <style>
       .print_table{
           width: 100%;
           border-collapse: collapse;
       }
    @media print {
        .razdel {
         page-break-inside: avoid;
    }
    
    
    </style>
   
   <body><?php
    error_reporting (0);
mysql_connect("localhost","root","slipknot");
mysql_select_db("good_mark");    
$checkUser=$_POST['user_id'];
$checkId=$_POST['app_id'];
 $appInformation=mysql_query("SELECT * FROM applications WHERE id='$checkId'");
    $arr=mysql_fetch_assoc($appInformation);
    print "<h3>".$arr['name']."</h3>
    <p class='print_value'>".$arr['value']."</p>";
 $sTables=mysql_query("SELECT table_id FROM app_id WHERE app_id='$checkId'");//получаем Н записей с номерами таблиц которые есть в данном конкурсе
 $colTables=mysql_num_rows($sTables);
 
 for( $i = 0; $i < $colTables; $i ++ ){

     $idTable=mysql_result($sTables,$i);
     $nameTable=mysql_result(mysql_query("SELECT name FROM tables WHERE id='$idTable'"),0);
     $sStringId=mysql_query("SELECT string_id FROM table_id WHERE table_id='$idTable'");
     $colString=mysql_num_rows($sStringId);
     print "<div class='razdel'><h3 class='print_table_title'>".$nameTable."</h3><table class='print_table' border=1>";

     for( $j = 0 ; $j < $colString ; $j ++ ){

         $idString=mysql_result($sStringId,$j);//идентификатор строки
         $id=mysql_result(mysql_query("SELECT id FROM request WHERE table_id='$idTable' AND string_id='$idString' AND user_id='$checkUser'"),0);
         //print "<script>alert('".$idTable."---".$idString."---".$checkUser."');</script>";
         $nameString=mysql_result(mysql_query("SELECT name FROM string WHERE id='$idString'"),0);//получаем название строки
         $userValue=mysql_result(mysql_query("SELECT value FROM request WHERE string_id='$idString' AND user_id='$checkUser'"),0);//получаем значение введенное пользователем
         print "<tr><td><b>".$nameString.":</b></td><td>".$userValue."</td></tr>";
     }
     print "</table></div>";
 }
       print "<b>
         <br><br>Руководитель организации-заявителя______________________ / ____________________/<br>
     (ФИО полностью)<br>
    «___» ________2016 г.<br>
    М.П.<br>
    Руководитель мероприятия ________________________________ / ____________________/<br>
     (ФИО полностью)</b><br><br><br>
        ";
 
?>
</body></html>