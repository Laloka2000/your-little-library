<?php

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

?>

<header class="site-header">
    <div class="container">
        <div class="header-content">
            <a href="index.php" class="logo">
                📚 <?php echo defined('SITE_NAME') ? SITE_NAME : 'Your Online Library'; ?>
            </a>

            <nav class="main-nav">
                <a href="index.php">Főoldal</a>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="my-books.php">Saját könyvtár</a>
                    <a href="upload.php">Könyv feltöltése</a>
                    <div class="user-menu">
                        <span class="username">
                            <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </span>
                        <a href="logout.php" class="logout">Kijelentkezés</a>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="btn btn-primary">Bejelentkezés</a>
                    <a href="register.php" class="btn btn-secondary">Regisztráció</a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>