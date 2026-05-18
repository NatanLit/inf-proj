<?php

include("db.php");

$name = $_POST['name'];
$age = $_POST['age'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$check = mysqli_query($conn,
"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check) > 0){
    die("Пользователь уже существует");
}

$sql = "INSERT INTO users(name, age, email, password)
VALUES('$name','$age','$email','$password')";

if(mysqli_query($conn,$sql)){
    header("Location: login.html");
} else {
    echo "Ошибка регистрации";
}

?>