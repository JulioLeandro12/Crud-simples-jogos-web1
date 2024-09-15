<?php
session_start();

function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

function authenticate($username, $password) {
    global $pdo;

    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['usuarios_id'];
        return true;
    }
    return false;
}

function logout() {
    session_unset();
    session_destroy();
}
?>