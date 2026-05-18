<?php
$host = getenv('MYSQLHOST');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD');
$db   = getenv('MYSQLDATABASE');
$port = getenv('MYSQLPORT');

$conn = mysqli_connect($host, $user, $pass, $db, (int)$port);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
?>
