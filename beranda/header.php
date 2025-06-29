<?php
include 'connect.php';
$loggedInUser = isset($_SESSION['user']) ? $_SESSION['user']['username'] : null;
?>
<header>
    <div class="container header"> 
        <h1 class="logo">MY NUSANTARA</h1>
        <nav class="header-icons">
            <a href="index1.php"><img src="https://indonesiakaya.com/wp-content/themes/indonesiakaya-X2/images/svg/icon__home.svg" alt="Home" class="icon" style="width: 45px; height: 45px; "></a>
            <?php if ($loggedInUser): ?>
                <?php if (!empty($_SESSION['user']['pp_user'])): ?>
                    <a href="dasbor.php"><img src="/MY_NUSANTARA/admin/uploads/<?php echo htmlspecialchars($_SESSION['user']['pp_user']); ?>" alt="User" class="icon" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;"></a>
                <?php else: ?>
                    <a href="dasbor.php"><img src="/MY_NUSANTARA/image/image.png" alt="User" class="icon"></a>
                <?php endif; ?>
            <?php else: ?>
                <a href="login.php" id="loginButton"><img src="/MY_NUSANTARA/image/image.png" alt="User" class="icon"></a>
            <?php endif; ?>
            <a href="keranjang.php"><img src="/MY_NUSANTARA/image/cart.png" alt="Cart" class="icon" style="width: 43px; height: 45px;"></a>
        </nav>
    </div>
</header>
