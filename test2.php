<form action = "test2.php" method = "post" enctype = 'multipart/form-data'>
  <input type = "file" name = "someone" />
    <input type='text' name='name1'>
    <input type='text' name='name2'>
  <input type = "submit" value = "Загрузить" />
</form>
<?php
phpinfo();
nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn
  /*$type = $_FILES['somename']['type'];
  $size = $_FILES['somename']['size'];
print $_FILES["someone"]["name"];
if(is_uploaded_file($_FILES["someone"]["tmp_name"]))
   {
      if (($size < 10240000) && ($type == "image/jpg" || $type == "image/jpeg")){
          $uploadfile = $_FILES['somename']['tmp_name'];
          move_uploaded_file($_FILES['somename']['tmp_name'], $uploadfile);
      }else{
          print "ERROR!";
      }
}else{
    print "file not upload!";
}
print $_POST['name1']."-".$_POST['name2'];
$name = 'werwe';
if (isset($_FILES['someone']['name'])) 
{
$file_name = $_FILES['someone']['name']; 
$filetype1 = explode('.', $file_name);
$filetype = $filetype1[count($filetype1)-1];
if ($filetype == "jpg" || $filetype == "jpeg" || $filetype == "gif" || $filetype == "bmp" || $filetype == "png" && $_FILES['FILE']['size'] != 0)
{ 
if(is_uploaded_file($_FILES['someone']['tmp_name'])) 
{ 
    print "abc";
if (move_uploaded_file($_FILES['someone']['tmp_name'], "images/".basename($name.'.'.$filetype))) 
echo "Файл успешно загружен!";
}else{
    print "aaa";
}
}else{
    print "bbb";
}
}else{
    print "ccc";
}
*/
if(mkdir("applications/12345",0777)){
    print "Y";
}else{
    print "N";
}
?>