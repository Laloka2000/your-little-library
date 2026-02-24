<?php
require_once 'config.php';
require_once 'includes/functions.php';
require_once 'includes/User.php';

initSession();

if (isLoggedIn()){
    redirect('index.php');
}

$errors = [];
$formData = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    $formData = ['username' => $username, 'email' => $email];

    if(empty($username)){
        $erros[] = 'A felhasználónév megadása kötelező.';
    }

    if(empty($password)){
        $errors[] = 'A jelszó megadása kötelező.';
    }

    if(empty($email)){
        $errors[] = 'Az email cím megadása kötelező.';
    } 

    if($password !== $confirmPassword){
        $errors[] = 'A két jelszó nem egyezik.';
    }

    if(empty($errors)){
        $user = new User();
        $result = $user->register($username, $email, $password);

        if ($result['success']){
            setFlash('success', 'Sikeres regisztráció! Most már bejelentkezhetsz.');
            redirect('login.php');
        } else {
            $errors[] = $result['error'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">
    <div class="container">
        <div class="auth-box">
            <h1>Regisztráció</h1>
            
            <?php if (isset($errors['general'])): ?>
                <div class="alert alert-error"><?php echo e($errors['general']); ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Felhasználónév</label>
                    <input type="text" id="username" name="username" 
                           value="<?php echo e($formData['username'] ?? ''); ?>" required>
                    <?php if (isset($errors['username'])): ?>
                        <span class="error"><?php echo e($errors['username']); ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="email">Email cím</label>
                    <input type="email" id="email" name="email" 
                           value="<?php echo e($formData['email'] ?? ''); ?>" required>
                    <?php if (isset($errors['email'])): ?>
                        <span class="error"><?php echo e($errors['email']); ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="password">Jelszó</label>
                    <input type="password" id="password" name="password" required>
                    <small>Legalább 8 karakter, nagybetű, kisbetű és szám.</small>
                    <?php if (isset($errors['password'])): ?>
                        <span class="error"><?php echo e($errors['password']); ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Jelszó megerősítése</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <?php if (isset($errors['confirm_password'])): ?>
                        <span class="error"><?php echo e($errors['confirm_password']); ?></span>
                    <?php endif; ?>
                </div>
                
                <button type="submit" class="btn btn-primary">Regisztráció</button>
            </form>
            
            <p class="auth-link">
                Már van fiókod? <a href="login.php">Bejelentkezés</a>
            </p>
        </div>
    </div>
</body>
</html>