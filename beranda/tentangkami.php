<?php
    session_start();
    include 'connect.php';

    $loggedInUser = isset($_SESSION['user']) ? $_SESSION['user']['username'] : null;
?>  

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/tgkami.css">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Judson:wght@700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=El Messiri:wght@400;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ek Mukta:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
</head>
<body>
    <header>
        <div class="container">
            <h1 class="logo">MY NUSANTARA</h1>
            <nav class="header-icons">
                <a href="index1.php"><img src="/MY_NUSANTARA/image/home.png" alt="Cart" class="icon"></a>
                <?php if ($loggedInUser): ?>
                    <a href="dasbor.php"><img src="/MY_NUSANTARA/image/image.png" alt="User" class="icon"></a>
                <?php else: ?>
                    <a href="login.php" id="loginButton"><img src="/MY_NUSANTARA/image/image.png" alt="User" class="icon"></a>
                <?php endif; ?>
                <a href="keranjang.php"><img src="/MY_NUSANTARA/image/icon.png" alt="Cart" class="icon"></a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h2>Tentang Kami</h2>
        </div>
    </section>

    <section class="about-content">
        <div class="about-wrapper">
            <h3>Tentang My Nusantara</h3>
            <p>Selamat datang di My Nusantara, platform yang menghubungkan Anda dengan kekayaan budaya dan tradisi Indonesia. Kami berkomitmen untuk melestarikan dan mempromosikan warisan nusantara melalui berbagai acara, produk, dan informasi yang autentik dan terpercaya.</p>
            <p>My Nusantara adalah sebuah inisiatif yang bertujuan untuk memperkenalkan dan melestarikan budaya Indonesia yang beragam. Kami menyediakan platform yang mudah diakses untuk menemukan acara budaya, produk tradisional, dan informasi sejarah yang mendalam.</p>
            
            <h3>Misi Kami</h3>
            <p>Menghubungkan masyarakat dengan kekayaan budaya Indonesia melalui teknologi dan edukasi, serta mendukung pelaku budaya lokal untuk berkembang dan dikenal secara luas.</p>

            <h3>Visi Kami</h3>
            <p>Menjadi platform terdepan dalam pelestarian dan promosi budaya nusantara yang dikenal dan dihargai di tingkat nasional maupun internasional.</p>

            <h3>Nilai-Nilai Kami</h3>
            <ul>
                <li><strong>Autentisitas:</strong> Menyajikan informasi dan produk yang asli dan terpercaya.</li>
                <li><strong>Keberagaman:</strong> Menghargai dan merayakan keragaman budaya Indonesia.</li>
                <li><strong>Inovasi:</strong> Menggunakan teknologi untuk mempermudah akses dan edukasi budaya.</li>
                <li><strong>Komunitas:</strong> Membangun jaringan yang kuat antara pelaku budaya dan masyarakat.</li>
            </ul>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025 My Nusantara. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
