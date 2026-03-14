<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/config.php';
require_once 'includes/functions.php';
require_once 'includes/User.php';

session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$errors = [];
$username = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    
    if ($password !== $password2) {
        $errors['password2'] = 'A két jelszó nem egyezik.';
    }
    
    if (empty($errors)) {
        try {
            $user = new User();
            $result = $user->register($username, $email, $password);
            
            if ($result['success']) {
                $_SESSION['user_id'] = $result['user_id'];
                $_SESSION['username'] = $username;
                header('Location: index.php');
                exit;
            } else {
                $errors = $result['errors'];
            }
        } catch (Exception $e) {
            $errors['general'] = 'Hiba: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">
    <div class="container">
        <div class="auth-box">
            <h1>Regisztráció</h1>
            
            <?php if (isset($errors['general'])): ?>
                <div class="alert alert-error">
                    <?php echo htmlspecialchars($errors['general']); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Felhasználónév</label>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                    <?php if (isset($errors['username'])): ?>
                        <span class="error"><?php echo htmlspecialchars($errors['username']); ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label>Email cím</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    <?php if (isset($errors['email'])): ?>
                        <span class="error"><?php echo htmlspecialchars($errors['email']); ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label>Jelszó</label>
                    <input type="password" name="password" required>
                    <small>Legalább 8 karakter, nagybetű, kisbetű és szám.</small>
                    <?php if (isset($errors['password'])): ?>
                        <span class="error"><?php echo htmlspecialchars($errors['password']); ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label>Jelszó megerősítése</label>
                    <input type="password" name="password2" required>
                    <?php if (isset($errors['password2'])): ?>
                        <span class="error"><?php echo htmlspecialchars($errors['password2']); ?></span>
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