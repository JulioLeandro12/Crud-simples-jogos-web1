<?php
include 'db.php';

$username = 'admin';
$password = password_hash('123', PASSWORD_BCRYPT);

$stmt = $pdo->prepare('INSERT INTO usuarios (username, password) VALUES (?, ?)');
$stmt->execute([$username, $password]);

echo "Usuário criado com sucesso.";
?>
