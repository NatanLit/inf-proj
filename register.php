<?php
include("db.php");

if (empty($_POST['name']) || empty($_POST['age']) || empty($_POST['email']) || empty($_POST['password'])) {
    die("Заполните все поля");
}

$name     = mysqli_real_escape_string($conn, $_POST['name']);
$age      = (int) $_POST['age'];
$email    = mysqli_real_escape_string($conn, $_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
    die("Пользователь с таким email уже существует");
}

$sql = "INSERT INTO users (name, age, email, password) VALUES ('$name', '$age', '$email', '$password')";

if (mysqli_query($conn, $sql)) {
    header("Location: login.html");
    exit();
} else {
    echo "Ошибка регистрации: " . mysqli_error($conn);
}
?>
