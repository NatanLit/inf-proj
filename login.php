<?php
session_start();
include("db.php");

if (empty($_POST['email']) || empty($_POST['password'])) {
    die("Заполните все поля");
}

$email    = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password'];

$sql  = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($sql);

if ($user) {
    if (password_verify($password, $user['password'])) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['name']  = $user['name'];
        header("Location: profile.php");
        exit();
    } else {
        echo "Неверный пароль";
    }
} else {
    echo "Пользователь не найден";
}
?>
