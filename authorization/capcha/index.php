<?php
$login = md5('Evgeny');
$password = md5('1234');
	echo $_SESSION['captcha'];

if(isset($_POST['buttonInput'])){
	if($_POST['passwordInput'].length < 3){
		echo 'Password < 3 symbols';
	}

	else{
		$loginAccount = md5($_POST['loginInput']);
	$passwordAccount = md5($_POST['passwordInput']);
	if($loginAccount == $login && $passwordAccount == $password){
		$code = $_POST['captcha']; 
		session_start();
		if ( isset($_SESSION['captcha']) && strtoupper($_SESSION['captcha']) == strtoupper($code) ){
		session_start();
		$_SESSION['username'] = $_POST['loginInput'];
		header('Location: ./accaunt.php');
		}
		else
		echo 'Incorrect captcha';
		
	}

	else{
		echo 'Incorrect login or password';
	}
	}	
}
if ( isset($_POST['buttonImput']) )
{
$code = $_POST['captcha']; 
session_start();
if ( isset($_SESSION['captcha']) && strtoupper($_SESSION['captcha']) == strtoupper($code) )
echo 'Pravilno';
else
echo 'Nepravilno';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="index.css">
	<title>Document</title>
</head>
<body>
	<h2>Form</h2>
	<form action = '' method = 'post'>
<input type="login" name='loginInput'/><br>
<input type="password" name='passwordInput'/><br>
<img src='captcha.php' id='capcha-image'>
<br>
<a href="javascript:void(0);" onclick="document.getElementById('capcha-image').src='captcha.php?rid=' + Math.random();">Обновить капчу</a>
<br>
<br>
<input type="text" name="captcha" /><br/><br>
<input type="submit" name = 'buttonInput' value = 'Join'>
</form>
</body>
</html>

