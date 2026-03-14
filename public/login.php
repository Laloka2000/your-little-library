<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/config.php';
require_once 'includes/functions.php';
require_once 'includes/User.php';

session_start();

// Already logged in?
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $error = 'Kérlek add meg mindkét mezőt!';
    } else {
        try {
            $user = new User();
            $result = $user->login($username, $password);
            
            if ($result['success']) {
                $_SESSION['user_id'] = $result['user_id'];
                $_SESSION['username'] = $result['username'];
                header('Location: index.php');
                exit;
            } else {
                $error = $result['error'];
            }
        } catch (Exception $e) {
            $error = 'Hiba: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">
    <div class="container">
        <div class="auth-box">
            <h1>Bejelentkezés</h1>
            
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Felhasználónév</label>
                    <input type="text" name="username" required>
                </div>
                
                <div class="form-group">
                    <label>Jelszó</label>
                    <input type="password" name="password" required>
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