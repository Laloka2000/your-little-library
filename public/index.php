<?php
require_once('../config/config.php');
require_once('../includes/functions.php');
require_once('../includes/Book.php');

initSession();

$book = new Book();
$books = $book->getAllBooks(20);
$flashSuccess = getFlash('success');
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Főoldal</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('includes/header.php'); ?>

    <main class="container">
        <section class="hero">
            <h1>Üdvözlünk az Online Könyvtárban!</h1>
            <p>Töltsd fel és kezeld könyvgyűjteményedet egy helyen.</p>

            <?php if (!isLoggedIn()): ?>
                <div class="hero-buttons">
                    <a href="login.php" class="btn btn-primary">Bejelentkezés</a>
                    <a href="register.php" class="btn btn-secondary">Regisztráció</a>
                </div>
            <?php endif; ?>
        </section>

        <?php if ($flashSuccess): ?>
            <div class="alert alert-success"><?php echo e($flashSuccess); ?></div>
        <?php endif; ?>

        <section class="books-section">
            <h2>Legutóbb feltöltött könyvek</h2>

            <?php if (empty($books)): ?>
                <p class="no-books">Még nincsenek feltöltött könyvek.</p>
            <?php else: ?>
                <div class="books-grid">
                    <?php foreach ($books as $bookItem): ?>
                        <div class="book-card">
                            <?php if ($bookItem['cover_image']): ?>
                                <img src="uploads/covers/<?php echo e($bookItem['cover_image']); ?>"
                                    alt="<?php echo e($bookItem['title']); ?>" class="book-cover">
                            <?php else: ?>
                                <div class="book-cover-placeholder"><span>📚</span></div>
                            <?php endif; ?>

                            <div class="book-info">
                                <h3><?php echo e($bookItem['title']); ?></h3>
                                <p class="book-author"><?php echo e($bookItem['author']); ?></p>
                                <p class="book-category"><?php echo e($bookItem['category_name'] ?? 'Nincs'); ?></p>

                                <?php if ($bookItem['pdf_file']): ?>
                                    <a href="uploads/books/<?php echo e($bookItem['pdf_file']); ?>" target="_blank"
                                        class="btn btn-small">Megtekintés</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>
    <?php include('includes/footer.php'); ?>
</body>
</html>