<?php
session_start();
include("db.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$email = mysqli_real_escape_string($conn, $_SESSION['email']);

// Сохранение данных
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = mysqli_real_escape_string($conn, $_POST['name']);
    $age    = (int) $_POST['age'];
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    // Загрузка аватарки
    $avatarSQL = "";
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
        $imageData = base64_encode(file_get_contents($_FILES['avatar']['tmp_name']));
        $imageType = $_FILES['avatar']['type'];
        $avatarBase64 = "data:$imageType;base64,$imageData";
        $avatarEscaped = mysqli_real_escape_string($conn, $avatarBase64);
        $avatarSQL = ", avatar='$avatarEscaped'";
    }

    $update = mysqli_query($conn,
        "UPDATE users SET name='$name', age='$age', gender='$gender'$avatarSQL WHERE email='$email'"
    );

    if ($update) {
        $_SESSION['name'] = $name;
        $success = true;
    }
}

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user  = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Stabilia — Личный кабинет</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f6fbfa;
}

.container {
    display: flex;
    max-width: 1000px;
    margin: 40px auto;
    gap: 20px;
    padding-top: 40px;
}

.sidebar {
    width: 220px;
    background: white;
    border-radius: 20px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
}

.avatar {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: #e6f5f1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    color: #7DBDA1;
    margin: 0 auto 10px;
    overflow: hidden;
    cursor: pointer;
}

.avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.avatar-label {
    font-size: 12px;
    color: #7DBDA1;
    cursor: pointer;
    margin-bottom: 10px;
}

.name {
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
}

.menu {
    text-align: left;
}

.menu div {
    padding: 12px;
    border-radius: 10px;
    cursor: pointer;
    margin-bottom: 10px;
    transition: 0.2s;
}

.menu div:hover {
    background: #f0f9f6;
}

.menu a {
    text-decoration: none;
    color: black;
}

.main {
    flex: 1;
    background: white;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
}

h2 {
    margin-top: 0;
    color: #2f5f57;
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-size: 13px;
    color: #666;
    display: block;
    margin-bottom: 5px;
}

input, select {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #ddd;
    font-size: 14px;
    outline: none;
    box-sizing: border-box;
}

input:focus, select:focus {
    border-color: #7DBDA1;
}

.stats {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.stat {
    flex: 1;
    background: #f4fbf9;
    padding: 15px;
    border-radius: 15px;
    text-align: center;
}

.stat h3 {
    margin: 0;
    color: #7DBDA1;
}

.stat p {
    margin: 5px 0 0;
    font-size: 13px;
    color: #555;
}

.btn {
    margin-top: 15px;
    padding: 14px;
    border: none;
    border-radius: 12px;
    background: #7DBDA1;
    color: white;
    font-weight: 600;
    width: 100%;
    cursor: pointer;
}

.btn:hover {
    opacity: 0.9;
}

.success {
    background: #e6f5f1;
    color: #2f5f57;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 15px;
    text-align: center;
    font-size: 14px;
}
</style>
</head>

<body>

<div class="container">

    <div class="sidebar">
        <!-- Аватарка -->
        <label for="avatarInput">
            <div class="avatar">
                <?php if (!empty($user['avatar'])): ?>
                    <img src="<?php echo $user['avatar']; ?>" alt="avatar">
                <?php else: ?>
                    U
                <?php endif; ?>
            </div>
        </label>
        <div class="avatar-label">Нажми чтобы изменить</div>

        <div class="name"><?php echo htmlspecialchars($user['name']); ?></div>
        <div class="menu">
            <div>Статистика</div>
            <div>Настройки</div>
            <div>Состояние</div>
            <div><a href="index.php">Главная</a></div>
            <div><a href="logout.php">Выйти</a></div>
        </div>
    </div>

    <div class="main">
        <h2>Личные данные</h2>

        <?php if ($success): ?>
            <div class="success">Данные успешно сохранены!</div>
        <?php endif; ?>

        <form method="POST" action="profile.php" enctype="multipart/form-data">

            <!-- Скрытый input для загрузки фото -->
            <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display:none">

            <div class="form-group">
                <label>Имя</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
            </div>

            <div class="form-group">
                <label>Возраст</label>
                <input type="number" name="age" value="<?php echo htmlspecialchars($user['age']); ?>" required>
            </div>

            <div class="form-group">
                <label>Пол</label>
                <select name="gender">
                    <option value="Не указан" <?php if($user['gender'] == 'Не указан') echo 'selected'; ?>>Не указан</option>
                    <option value="Мужской"   <?php if($user['gender'] == 'Мужской')   echo 'selected'; ?>>Мужской</option>
                    <option value="Женский"   <?php if($user['gender'] == 'Женский')   echo 'selected'; ?>>Женский</option>
                    <option value="Другой"    <?php if($user['gender'] == 'Другой')    echo 'selected'; ?>>Другой</option>
                </select>
            </div>

            <button type="submit" class="btn">Сохранить изменения</button>

        </form>

        <div class="stats">
            <div class="stat">
                <h3>72%</h3>
                <p>Снижение тремора</p>
            </div>
            <div class="stat">
                <h3>5ч</h3>
                <p>Сегодня</p>
            </div>
            <div class="stat">
                <h3>14</h3>
                <p>Сессий</p>
            </div>
        </div>
    </div>

</div>

<script>
// Предпросмотр аватарки до сохранения
document.getElementById('avatarInput').addEventListener('change', function() {
    var file = this.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var avatar = document.querySelector('.avatar');
            avatar.innerHTML = '<img src="' + e.target.result + '" alt="avatar">';
        };
        reader.readAsDataURL(file);
    }
});
</script>

</body>
</html>
