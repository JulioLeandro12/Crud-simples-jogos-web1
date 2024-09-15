<?php
include 'db.php';
include 'session.php';

if (!isAuthenticated()) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $ano_lancamento = $_POST['ano_lancamento'];

    $stmt = $pdo->prepare('INSERT INTO jogos (nome, descricao, ano_lancamento) VALUES (?, ?, ?)');
    $stmt->execute([$nome, $descricao, $ano_lancamento]);

    header('Location: index.php');
    exit;
}

if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    $arquivo = $_FILES['arquivo'];
    $nomeArquivo = $arquivo['name'];
    $caminhoArquivo = 'uploads/' . $nomeArquivo;

    // Move o arquivo para a pasta 'uploads'
    move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo);

    // Inserir dados do jogo e o caminho do arquivo no banco de dados
    $stmt = $pdo->prepare('INSERT INTO jogos (nome, descricao, ano_lancamento, arquivo) VALUES (?, ?, ?, ?)');
    $stmt->execute([$nome, $descricao, $ano_lancamento, $caminhoArquivo]);
} else {
    die('Erro no upload do arquivo.');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Novo Jogo</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <h1>CRUD de Jogos</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="create.php">Adicionar Novo Jogo</a>
            <a href="logout.php">Sair</a>
        </nav>
    </header>
    <div class="container">
        <h2>Adicionar Novo Jogo</h2>
        <form action="create.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <br>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"></textarea>
            <br>
            <label for="ano_lancamento">Ano de Lançamento:</label>
            <input type="number" id="ano_lancamento" name="ano_lancamento">
            <br>
            <label for="arquivo">Arquivo:</label>
            <input type="file" id="arquivo" name="arquivo" required>
            <br>
            <input type="submit" value="Adicionar">
        </form>
        <a href="index.php">Voltar</a>
    </div>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
