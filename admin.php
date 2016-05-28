<?php
setcookie("login",$_POST['login']);
setcookie("password",$_POST['password']);
?>
<form action="admin.php" method="POST">
    <input type='text' name='login'>
    <input type='password' name='password'>
    <input type="submit">
</form>