<?php
include 'db.php';
include 'session.php';

if (!isAuthenticated()) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare('DELETE FROM jogos WHERE id = ?');
$stmt->execute([$id]);

header('Location: index.php');
exit;
?>
