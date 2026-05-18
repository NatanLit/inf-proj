<?php

session_start();

include("db.php");

$email = $_POST['email'];
$password = $_POST['password'];

$sql = mysqli_query($conn,
"SELECT * FROM users WHERE email='$email'");

$user = mysqli_fetch_assoc($sql);

if($user){

    if(password_verify($password, $user['password'])){

        $_SESSION['email'] = $user['email'];

        header("Location: dashboard.php");
        exit();

    } else {

        echo "Неверный пароль";
    }

} else {

    echo "Пользователь не найден";
}

?>