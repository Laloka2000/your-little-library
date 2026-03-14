<?php
require_once('config/config.php');
require_once('includes/functions.php');
require_once('includes/Book.php');

initSession();

$book = new Book();
$books = $book->getAllBooks(20);
$flashSuccess = isset($_SESSION['flash_success']) ? $_SESSION['flash_success'] : null;

if ($flashSuccess) {
    unset($_SESSION['flash_success']);
}
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
    <?php include 'includes/header.php'; ?>
    
    <main class="container">
        <section class="hero">
            <h1>📚 Üdvözlünk az Online Könyvtárban!</h1>
            <p>Böngészd a könyveket és töltsd fel a sajátjaidat.</p>
        </section>
        
        <?php if ($flashSuccess): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($flashSuccess); ?>
            </div>
        <?php endif; ?>
        
        <section class="books-section">
            <h2>Legutóbb feltöltött könyvek</h2>
            
            <?php if (empty($books)): ?>
                <p class="no-books">Még nincsenek feltöltött könyvek. 
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="upload.php">Legyél te az első!</a>
                    <?php else: ?>
                        <a href="register.php">Regisztrálj</a> és legyél te az első!
                    <?php endif; ?>
                </p>
            <?php else: ?>
                <div class="books-grid">
                    <?php foreach ($books as $bookItem): ?>
                        <div class="book-card">
                            <?php if ($bookItem['cover_image']): ?>
                                <img src="uploads/covers/<?php echo htmlspecialchars($bookItem['cover_image']); ?>" 
                                     alt="<?php echo htmlspecialchars($bookItem['title']); ?>" 
                                     class="book-cover">
                            <?php else: ?>
                                <div class="book-cover-placeholder">
                                    <span>📚</span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="book-info">
                                <h3><?php echo htmlspecialchars($bookItem['title']); ?></h3>
                                <p class="book-author">Szerző: <?php echo htmlspecialchars($bookItem['author']); ?></p>
                                
                                <?php if (!empty($bookItem['category_name'])): ?>
                                    <p class="book-category">
                                        <span class="badge"><?php echo htmlspecialchars($bookItem['category_name']); ?></span>
                                    </p>
                                <?php endif; ?>
                                
                                <p class="book-uploader">
                                    Feltöltötte: <strong><?php echo htmlspecialchars($bookItem['username']); ?></strong>
                                </p>
                                
                                <?php if ($bookItem['pdf_file']): ?>
                                    <a href="uploads/books/<?php echo htmlspecialchars($bookItem['pdf_file']); ?>" 
                                       target="_blank" 
                                       class="btn btn-small btn-primary">
                                        📖 Megtekintés
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>