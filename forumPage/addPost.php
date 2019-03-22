<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add forum</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php
        include('../header_footer/header_not_auth.php')
        ?>
        <form method='POST' class='add_post_form'>
            <label>Название</label><input type="text" class='add_post_name' name='post_name'>
            <label>Язык</label><input type="text" class='add_post_language' name='post_language'>
            <label>Наполнение</label><textarea type="text" class='add_post_content' name='post_content'></textarea>
            <input type="submit" class='add_post_submit' name='add'>
        </form>
    </div>
        <?php
        include('../header_footer/footer.html')
        ?>
</body>

</html>

<?php
$host = "localhost";
$database = "DBlog";
$user = "mysql";
$password = "mysql";
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

$user_id = $_SESSION['id'];
$name = $_POST['post_name'];
$content = $_POST['post_content'];
$language = $_POST['post_language'];

$query_name = "INSERT INTO `forum`(`name`, `text`, `user_id`, `language`) VALUES ('$name', '$content', '$user_id', '$language')";

if (isset($_POST['add'])) {
    $name = stripslashes($name);
    $name = htmlspecialchars($name);
    $content = stripslashes($content);
    $content = htmlspecialchars($content);
    $name = trim($name);
    $content = trim($content);
    if (empty($name) || empty($content) || empty($language)) {
        echo "<script>alert('Вы ввели не всю информацию. Все поля должны быть заполнены')</script>";
        mysqli_close($link);
    }
    elseif(!preg_match("~[a-zA-Z\d]{5,}~", $name)) {
        echo "<script>alert('Некорректное имя.')</script>";
        mysqli_close($link);
    }
    elseif(!preg_match("~[0-9A-Za-z!@#$%]{5,}~", $name)) {
        echo "<script>alert('Некорректное содержимое.')</script>";
        mysqli_close($link);
    }
    else{
        mysqli_query($link, $query_name);
        echo "<script>location.pathname='/DBlog/forumPage/forum.php'</script>";
    }
}
?> 