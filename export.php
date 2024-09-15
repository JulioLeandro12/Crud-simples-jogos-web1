<?php
require 'vendor/autoload.php'; // Carregar as dependências do Composer
use Dompdf\Dompdf;
use Dompdf\Options;

include 'db.php'; // Conexão com o banco de dados

// Configurações do Dompdf
$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);

// pega os dados do banco de dados
$stmt = $pdo->query('SELECT id, nome, descricao, ano_lancamento FROM jogos');
$jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Gerar o conteúdo html pra pdf
$html = '<h1>Lista de Jogos</h1>';
$html .= '<table border="1" width="100%" cellpadding="5">';
$html .= '<thead><tr><th>ID</th><th>Nome</th><th>Descrição</th><th>Ano de Lançamento</th></tr></thead>';
$html .= '<tbody>';

foreach ($jogos as $jogo) {
    $html .= '<tr>';
    $html .= '<td>' . $jogo['jogos_id'] . '</td>';
    $html .= '<td>' . $jogo['nome'] . '</td>';
    $html .= '<td>' . $jogo['descricao'] . '</td>';
    $html .= '<td>' . $jogo['ano_lancamento'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody></table>';

// Passa o HTML para o Dompdf e renderiza
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape'); // Define o tamanho do papel
$dompdf->render();

// Envia o PDF para o navegador
$dompdf->stream("lista_jogos.pdf", ["Attachment" => false]);
?>
