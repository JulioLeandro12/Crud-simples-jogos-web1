<?php
include 'db.php';
include 'session.php';

if (!isAuthenticated()) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->query('SELECT * FROM jogos');
$jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Jogos</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
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
        <div class="table-container">
            <h2>Lista de Jogos</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ano de Lançamento</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($jogos as $jogo): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($jogo['jogos_id']); ?></td>
                        <td><?php echo htmlspecialchars($jogo['nome']); ?></td>
                        <td><?php echo htmlspecialchars($jogo['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($jogo['ano_lancamento']); ?></td>
                        <td>
                        <button class="defaultButton"><a class="defaultButton" href="edit.php?id=<?php echo $jogo['jogos_id']; ?>">Editar</a></button> 
                        <button class="defaultButton"><a class="defaultButton" href="delete.php?id=<?php echo $jogo['jogos_id']; ?>">Excluir</a></button>                       
                        <!-- ideia de melhora seria mudar o excluir com js simples e criar um modal estilo pop-up -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <button class="defaultButton"><a href="export.php">Exportar PDF</a></button>
        </div>
    </div>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
