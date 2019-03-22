<?php
$host = "localhost";
$database = "DBlog";
$user = "mysql";
$password = "mysql";
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

if (session_id() == '');
session_start();
if (isset($_POST['login'])) {
    $login = $_POST['login'];
    if ($login == '') {
        unset($login);
    }
} //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if ($password == '') {
        unset($password);
    }
}
if (empty($login) or empty($password)) {
    echo "<script>alert('Вы ввели не всю информацию. Все поля должны быть заполнены.'); location.pathname='/DBlog/authorization/authorization.php'</script>";
}
$login = stripslashes($login);
$login = htmlspecialchars($login);
$password = stripslashes($password);
$password = htmlspecialchars($password);
$login = trim($login);
$password = trim($password);

$query = "SELECT * FROM user WHERE name='$login'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_row($result);

if (empty($row[0])) {
        echo "<script>alert('Неверный логин или пароль.'); location.pathname='/DBlog/authorization/authorization.php'</script>";
        mysqli_close($link);
    } else {
    if ($row[2] == $password) {
        $username = $_POST['username'];
        $secretKey = "6LcjEJkUAAAAAKOXBL9PLrUXC3DndD_XIMZD5-6i";
        $responseKey = $_POST['g-recaptcha-response'];
        $userIP = $_SERVER['REMOTE_ADDR'];

        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
        $response = file_get_contents($url);
        $response = json_decode($response);
        if ($response->success) {
            $_SESSION['id'] = $row[0];
            $_SESSION['login'] = $row[1];
            $_SESSION['email'] = $row[3];
            $_SESSION['admin'] = $row[4];
            echo "<script>location.pathname='/DBlog/newsPage/news.php'</script>";
        } else
            echo "<script>alert('Подтвердите, что вы не робот.'); location.pathname='/DBlog/authorization/authorization.php'</script>";
    } else {
        echo "<script>alert('Неверный логин или пароль.'); location.pathname='/DBlog/authorization/authorization.php'</script>";
        mysqli_close($link);
    }
}
 