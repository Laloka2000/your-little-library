<?php 

require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/user.php';

initSession();

if (isLoggedIn()) {
    redirect('index.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username)) {
        $errors[] = 'A felhasználónév megadása kötelező.';
    }

    if (empty($password)) {
        $errors[] = 'A jelszó megadása kötelező.';
    }

    if (empty($errors)) {
        $user = new User();
        $result = $user->login($username, $password);

        if ($result['success']){
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['username'] = $result['username'];
            setFlash('sucess', 'Sikeres bejelentkezés!');
            redirect('index.php');
        } else {
            $errors['general'] = $result['error'];
        } 
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">
    <div class="container">
        <div class="auth-box">
            <h1>Bejelentkezés</h1>

            <?php if (isset($errors['general'])): ?>
                <div class="alert alert-error"><?php echo e($errors['general']); ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Felhasználónév</label>
                    <input type="text" id="username" name="username"
                        value="<?php echo e($_POST['username'] ?? ''); ?>" required>
                    <?php if(isset($errors['username'])): ?>
                        <span class="error"><?php echo e($errors['username']); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Jelszó</label>
                    <input type="password" id="password" name="password" required>
                    <?php if(isset($errors['password'])): ?> 
                        <span class="error"><?php echo e($errors['password']); ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary">Bejelentkezés</button>
            </form>

            <p class="auth-link">
                Még nincs fiókod? <a href="register.php">Regisztráció</a>
            </p>
        </div>
    </div>
</body>
</html>