<?php
include 'db.php';
include 'session.php';

if (!isAuthenticated()) {
    header('Location: login.php');
    exit;
}

$id = $_GET['jogos_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $ano_lancamento = $_POST['ano_lancamento'];

    $stmt = $pdo->prepare('UPDATE jogos SET nome = ?, descricao = ?, ano_lancamento = ? WHERE id = ?');
    $stmt->execute([$nome, $descricao, $ano_lancamento, $id]);

    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM jogos WHERE id = ?');
$stmt->execute([$id]);
$jogo = $stmt->fetch(PDO::FETCH_ASSOC);

// ---------------- Arquivo ----------------
if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    $arquivo = $_FILES['arquivo'];
    $nomeArquivo = $arquivo['name'];
    $caminhoArquivo = 'uploads/' . $nomeArquivo;

    move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo);
    $stmt = $pdo->prepare('UPDATE jogos SET nome = ?, descricao = ?, ano_lancamento = ?, arquivo = ? WHERE id = ?');
    $stmt->execute([$nome, $descricao, $ano_lancamento, $caminhoArquivo, $id]);
} else {
    $stmt = $pdo->prepare('UPDATE jogos SET nome = ?, descricao = ?, ano_lancamento = ? WHERE id = ?');
    $stmt->execute([$nome, $descricao, $ano_lancamento, $id]);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Jogo</title>
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
        <h2>Editar Jogo</h2>
        <form action="edit.php?id=<?php echo $jogo['jogos_id']; ?>" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($jogo['nome']); ?>" required>
            <br>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"><?php echo htmlspecialchars($jogo['descricao']); ?></textarea>
            <br>
            <label for="ano_lancamento">Ano de Lançamento:</label>
            <input type="number" id="ano_lancamento" name="ano_lancamento" value="<?php echo htmlspecialchars($jogo['ano_lancamento']); ?>">
            <br>
            <label for="arquivo">Novo Arquivo:</label>
            <input type="file" id="arquivo" name="arquivo">
            <br>
            <input type="submit" value="Atualizar">
        </form>
       <button class="defaultButton"><a class="defaultButton" href="index.php">Voltar</a></button>
    </div>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
