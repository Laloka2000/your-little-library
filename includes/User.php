<?php
require_once("includes/User.php");

class User{
    private $db;

    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function register($username, $email, $password){
        $errors = false;

        if (strlen($username) < 3){
            $errors["username"] = "A felhasználónév legalább 3 karakter hosszú legyen.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Érvénytelen email cím.';
        }

        if(strlen($password) < PASSWORD_MIN_LENGTH){
            $errors['password'] = 'A jelszónak legalább ' . PASSWORD_MIN_LENGTH . ' karakter hosszúnak kell lennie.';
        }

        if (!preg_match('/[A-Z]/', $password)){
            $errors['password'] = 'A jelszónak tartalmaznia kell legalább egy nagybetűt.';
        }

        if(!preg_match('/[0-9]/', $password)){
            $errors['password'] = 'A jelszónak tartalmaznia kell legalább egy számot.';
        }

        if ($this->userNameExists($username)){
            $errors['username'] = 'Ez a felhasználónév már foglalt.';
        }

        if($this->emailExists($email)){
            $errors['email'] = 'Ez az email cím már regisztrálva van.';
        }

        if(!empty($errors)){
            return ['success' => false, 'errors' => $errors];
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";
        $result = $this->db->execute($sql, [$username, $email, $passwordHash]);

        if($result){
            return ["success" => true, 'user_id' => $this->db->lastInsertId()];
        }

        return ['success' => false, 'errors' => ['general' => 'Hiba történt a regisztráció során.']];
    }

    public function login($username, $password){
        $sql = "SELECT id, username, password_hash FROM where username = ?";
        $user = $this->db->queryOne($sql, [$username]);

        if(!$user){
            return ['success' => false, 'error' => 'Hibás felhasználóvév vagy jelszó'];
        }

        if(password_verify($password, $user['password_hash'])){
            $this->db->execute("UPDATE users SET last_login = NOW() WHERE id = ?", [$user['id']]);

            return [
                'success' => true,
                'user_id' => $user['id'],
                $username => $user['username'],
            ];
        }

        return ['success' => false, 'error' => 'Hibás felhasználónév vagy jelszó.'];
    }

    private function userNameExists($username){
        $sql = 'SELECT id FROM users WHERE username = ?';
        return $this->db->queryOne($sql, [$username]) !== false;
    }

    private function emailExists($email){
        $sql = 'SELECT id FROM users WHERE email = ?';
        return $this->db->queryOne($sql, [$email]) !== false;
    }
}

?>