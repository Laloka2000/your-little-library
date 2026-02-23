<?php

require_once '../config.php';
require_once '../includes/functions.php';
require_once '../includes/Book.php';

initSession();
requireLogin();

$book = new Book();
$errors = [];
$categories = $book->getCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $categoryId = $_POST['category_id'] ?? null;
    $summary = trim($_POST['summary'] ?? '');

    $coverImage = $_FILES['cover_image'] ?? null;
    $pdfFile = $_FILES['pdf_file'] ?? null;

    $result = $book->uploadBook(
        $_SESSION['user_id'],
        $title,
        $author,
        $categoryId,
        $summary,
        $coverImage,
        $pdfFile
    );

    if ($result['success']) {
        setFlash('success', 'Könyv sikeresen feltöltve!');
        redirect('my-books.php');
    } else {
        $errors[] = $result['error'];
    }
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Könyv feltöltése - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main class="container">
        <div class="upload-form-container">
            <h1>Új könyv feltöltése</h1>

            <?php if (isset($errors['general'])): ?>
                <div class="alert alert-error"><?php echo e($errors['general']); ?></div>
            <?php endif; ?>

            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Cím *</label>
                    <input type="text" id="title" name="title" value="<?php echo e($_POST['title'] ?? ''); ?>" required>
                    <?php if (isset($errors['title'])): ?>
                        <span class="error"><?php echo e($errors['title']); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="author">Szerző *</label>
                    <input type="text" id="author" name="author" value="<?php echo e($_POST['author'] ?? ''); ?>"
                        required>
                    <?php if (isset($errors['author'])): ?>
                        <span class="error"><?php echo e($errors['author']); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="category_id">Kategória</label>
                    <select id="category_id" name="category_id">
                        <option value="">Válassz kategóriát</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo (isset($_POST['category_id']) && $_POST['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                                <?php echo e($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="summary">Rövid leírás</label>
                    <textarea id="summary" name="summary" rows="4"><?php echo e($_POST['summary'] ?? ''); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="cover_image">Borítókép (JPG, PNG - max
                        <?php echo formatFileSize(UPLOAD_MAX_SIZE); ?>)</label>
                    <input type="file" id="cover_image" name="cover_image" accept="image/jpeg,image/png,image/jpg">
                    <?php if (isset($errors['cover'])): ?>
                        <span class="error"><?php echo e($errors['cover']); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="pdf_file">PDF fájl (max <?php echo formatFileSize(UPLOAD_MAX_SIZE); ?>)</label>
                    <input type="file" id="pdf_file" name="pdf_file" accept="application/pdf">
                    <?php if (isset($errors['pdf'])): ?>
                        <span class="error"><?php echo e($errors['pdf']); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Feltöltés</button>
                    <a href="my-books.php" class="btn btn-secondary">Mégse</a>
                </div>
            </form>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>