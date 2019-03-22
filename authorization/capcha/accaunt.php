<?php
session_start();
echo '<h1>Hello ', $_SESSION['username'],'</h1>';

if(isset($_POST['exitButton'])){
	unset($_SESSION['username']);
	session_destroy();
	echo "<script> window.location = './index.php'</script>";
}
?>
<br>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="./index.css">
	<title>Document</title>
</head>
<body>
	<form action = '' method = 'post'>
<input type="submit" name = 'exitButton' value = 'Close session'>
</form>
</body>
</html>
