<?php
$email = $_POST['email'];
    mail("$email", 'Рассылка', 'Вы подписались на рассылку', 'From: dewblogphp@gmail.com');
    echo "<script>alert('Поздраляем, вы подписанались на рассылку!'); location.pathname='/DBlog/newsPage/news.php'</script>";
?>
