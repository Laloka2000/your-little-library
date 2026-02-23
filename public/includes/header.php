<header class="site-header">
    <div class="container">
        <div class="header-content">
            <a href="index.php" class="logo">
                📚 <?php echo SITE_NAME; ?>
            </a>

            <nav class="main-nav">
                <a href="index.php">Főoldal</a>

                <?php if (isLoggedIn()): ?>
                    <a href="my-books.php">Saját könyvtár</a>
                    <a href="upload.php">Könyv feltöltése</a>
                    <div class="user-menu">
                        <span>
                            <?php echo e($_SESSION['username']); ?>
                        </span>
                        <a href="logout.php" class="logout">Kijelentkezés</a>
                    </div>
                <?php else: ?>
                    <a href="login.php">Bejelentkezés</a>
                    <a href="register.php">Regisztráció</a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>