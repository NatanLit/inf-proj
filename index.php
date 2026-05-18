<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Stabilia</title>

<style>
body {
    margin: 0;
    font-family: "Montserrat", sans-serif;
    background: #f4f7fb;
}

html {
    scroll-behavior: smooth;
}

nav {
    width: 100%;
    background: #508A57;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100;
    box-sizing: border-box;
}

nav img {
    height: 45px;
}

nav a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
    font-weight: 600;
}

nav a:hover {
    opacity: 0.7;
}

.section-page {
    display: none;
    animation: fade .4s ease;
}

.section-page.active {
    display: block;
}

@keyframes fade {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero {
    height: 100vh;
    background:
      linear-gradient(to right, rgba(30, 51, 33, .6), rgba(152, 251, 152,.2)),
      #dceadf;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    padding: 20px;
}

.hero-content {
    max-width: 1100px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 50px;
    align-items: center;
}

.hero h1 {
    font-size: 56px;
    margin-bottom: 20px;
}

.hero p {
    font-size: 20px;
    line-height: 1.5;
}

.hero button {
    margin-top: 30px;
    padding: 15px 35px;
    font-size: 16px;
    border: none;
    border-radius: 30px;
    background: #508A57;
    color: white;
    cursor: pointer;
}

.hero button:hover {
    opacity: 0.9;
}

.hero-image img {
    width: 100%;
    border-radius: 25px;
    box-shadow: 0 25px 50px rgba(0,0,0,.25);
}

.page {
    padding: 120px 60px;
}

.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}

.card {
    height: 360px;
    border-radius: 22px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 15px 30px rgba(0,0,0,.15);
}

.card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card-info {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,.75), rgba(255,255,255,.05));
    backdrop-filter: blur(6px);
    color: white;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}

.price {
    font-weight: bold;
    font-size: 18px;
}
</style>
</head>

<body>

<nav>
    <a href="index.php">
        <img src="https://i.ibb.co.com/N6bsP3NL/White-and-Brown-Modern-Construction-Presentation.png" alt="logo">
    </a>

    <div>
        <a href="#home">Главная</a>
        <a href="#products">Продукты</a>
        <a href="#about">О нас</a>
        <a href="#contact">Контакты</a>

        <?php if(isset($_SESSION['email'])): ?>

            <a href="dashboard.php">Личный кабинет</a>
            <a href="logout.php">Выйти</a>

        <?php else: ?>

            <a href="register.html">Регистрация</a>
            <a href="login.html">Вход</a>

        <?php endif; ?>
    </div>
</nav>

<section id="home" class="section-page active">
    <div class="hero">
        <div class="hero-content">

            <div>
                <h1>Stabilia - баланс, который остается с тобой.</h1>

                <p>
                    Stabilia создаёт современные аксессуары для стабилизации тремора,
                    сочетая технологии и заботу о людях.
                </p>

                <button onclick="showPage('products')">
                    Подробнее
                </button>
            </div>

            <div class="hero-image">
                <img src="https://theawarenessstore.com/cdn/shop/products/IMG_1757.jpg?v=1527230830">
            </div>

        </div>
    </div>
</section>

<section id="products" class="section-page page">

    <h2>Наши продукты</h2>

    <div class="cards">

        <div class="card">
            <img src="https://images.unsplash.com/photo-1635776062043-223faf322554?q=80&w=1200&auto=format&fit=crop">

            <div class="card-info">
                <h3>Рукав</h3>

                <p>
                    Подходит для ежедневной носки без дискомфорта
                </p>

                <div class="price">20 000 ₸</div>
            </div>
        </div>

        <div class="card">
            <img src="https://images.unsplash.com/photo-1634017839464-5c339ebe3cb4?q=80&w=1200&auto=format&fit=crop">

            <div class="card-info">
                <h3>Браслет</h3>

                <p>
                    Стиль и удобство в одном
                </p>

                <div class="price">12 000 ₸</div>
            </div>
        </div>

        <div class="card">
            <img src="https://images.unsplash.com/photo-1614850523296-d8c1af93d400?q=80&w=1200&auto=format&fit=crop">

            <div class="card-info">
                <h3>Кастомизация аксессуаров</h3>

                <p>
                    Ваши фантазии в личном аксессуаре
                </p>

                <div class="price">5 000 ₸</div>
            </div>
        </div>

    </div>

</section>

<section id="about" class="section-page page">

    <h2>О нас</h2>

    <p>
        Stabilia - это решения, которые помогают чувствовать больше контроля,
        стабильности и спокойствия в повседневной жизни.
    </p>

</section>

<section id="contact" class="section-page page">

    <h2>Контакты</h2>

    <p><b>Телефон:</b> +7 705 000 00 00</p>
    <p><b>Email:</b> stabilia@gmail.com</p>

</section>

<script>

const pages = document.querySelectorAll('.section-page');

function showPage(id) {

    pages.forEach(p => p.classList.remove('active'));

    document.getElementById(id).classList.add('active');
}

document.querySelectorAll('nav a').forEach(link => {

    link.addEventListener('click', e => {

        const href = link.getAttribute('href');

        if(href.startsWith("#")) {

            const id = href.replace('#', '');

            if(document.getElementById(id)) {

                e.preventDefault();

                showPage(id);
            }
        }
    });
});

</script>

</body>
</html>