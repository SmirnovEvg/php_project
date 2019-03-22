<?php
session_start();
$host = "localhost";
$database = "DBlog";
$user = "mysql";
$password = "mysql";
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url)[1];
$user_id = $_SESSION['id'];
$name = $_POST['post_name'];
$content = $_POST['post_content'];
$language = $_POST['post_language'];

$query = "SELECT `name`, `language`, `content` FROM `post` WHERE `post_id` = '$url'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$query_delete = "DELETE FROM `post` WHERE `post_id` = '$url'";
$query_change = "UPDATE `post` SET `name` = '$name', `language` = '$language', `content` = '$content' WHERE `post_id` = '$url'";

if (isset($_POST['change'])) {
    mysqli_query($link, $query_change) or die("Ошибка " . mysqli_error($link));
    header('Location: ./lessons.php');
}
if (isset($_POST['delete'])) {
    mysqli_query($link, $query_delete) or die("Ошибка " . mysqli_error($link));
    header('Location: ./lessons.php');
}

if ($result) {
    $rows = mysqli_num_rows($result);
    for ($i = 0; $i < $rows; ++$i) {
        $row = mysqli_fetch_row($result);
    }
}
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
            <label>Название</label><input type="text" class='add_post_name' name='post_name' value='<?= $row[0]?>'>
            <label>Язык</label><input type="text" class='add_post_language' name='post_language' value='<?= $row[1]?>'>
            <label>Наполнение</label><textarea type="text" class='add_post_content' name='post_content'><?= $row[2]?></textarea>
            <div>
                <input type="submit" class='add_post_submit' name='change' value='Изменить запись'>
                <input type="submit" class='delete_post_submit' name='delete' value='Удалить запись'>
            </div>
        </form>
    </div>
    <?php
    include('../header_footer/footer.html')
    ?>
</body>

</html>

