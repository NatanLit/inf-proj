<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "stabilia";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
?>
