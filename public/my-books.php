<?php

require_once '../config.php';
require_once '../includes/functions.php';
require_once '../includes/Book.php';

initSession();
requireLogin();

$book = new Book();
$myBooks = $book->getBooksByUserId($_SESSION['user_id']);
$flashSuccess = getFlash('success');

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $result = $book->deleteBook($_GET['delete'], $_SESSION['user_id']);
    if ($result['success']) {
        setFlash('success', 'Könyv sikeresen törölve.');
    } else {
        setFlash('error', $result['error']);
    }
    redirect('my-books.php');
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saját könyveim - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main class="container">
        <div class="page-header">
            <h1>Saját könyveim</h1>
            <a href="upload.php" class="btn btn-primary">Új könyv feltöltése</a>
        </div>

        <?php if ($flashSuccess): ?>
            <div class="alert alert-success"><?php echo e($flashSuccess); ?></div>
        <?php endif; ?>

        <?php if ($flashError = getFlash('error')): ?>
            <div class="alert alert-error"><?php echo e($flashError); ?></div>
        <?php endif; ?>

        <?php if (empty($myBooks)): ?>
            <div class="empty-state">
                <p>Még nem töltöttél fel egyetlen könyvet sem.</p>
                <a href="upload.php" class="btn btn-primary">Első könyv feltöltése</a>
            </div>
        <?php else: ?>
            <div class="books-list">
                <?php foreach ($myBooks as $bookItem): ?>
                    <div class="book-item">
                        <div class="book-item-image">
                            <?php if ($bookItem['cover_image']): ?>
                                <img src="uploads/covers/<?php echo e($bookItem['cover_image']); ?>"
                                    alt="<?php echo e($bookItem['title']); ?>">
                            <?php else: ?>
                                <div class="placeholder">📚</div>
                            <?php endif; ?>
                        </div>

                        <div class="book-item-details">
                            <h3><?php echo e($bookItem['title']); ?></h3>
                            <p class="author">Szerző: <?php echo e($bookItem['author']); ?></p>
                            <p class="category">Kategória: <?php echo e($bookItem['category_name'] ?? 'Nincs'); ?></p>
                            <?php if ($bookItem['summary']): ?>
                                <p class="summary"><?php echo e($bookItem['summary']); ?></p>
                            <?php endif; ?>
                            <p class="date">Feltöltve: <?php echo formatDate($bookItem['created_at']); ?></p>
                        </div>

                        <div class="book-item-actions">
                            <?php if ($bookItem['pdf_file']): ?>
                                <a href="uploads/books/<?php echo e($bookItem['pdf_file']); ?>" target="_blank"
                                    class="btn btn-small btn-primary">Megtekintés</a>
                            <?php endif; ?>
                            <a href="?delete=<?php echo $bookItem['id']; ?>" class="btn btn-small btn-danger"
                                onclick="return confirm('Biztosan törölni szeretnéd ezt a könyvet?')">Törlés</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>