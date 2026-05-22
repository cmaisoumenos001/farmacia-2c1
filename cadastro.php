<?php
require_once 'config/conexao.php';
require_once 'includes/header.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $fabricante = $_POST['fabricante'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    try {
        $sql = "INSERT INTO produtos (nome, fabricante, preco, estoque) VALUES (:nome, :fabricante, :preco, :estoque)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':nome'       => $nome,
            ':fabricante' => $fabricante,
            ':preco'      => $preco,
            ':estoque'    => $estoque
        ]);

        $mensagem = "<p style='color:green; text-align:center;'>Produto inserido com sucesso!</p>";
    } catch (PDOException $erro) {
        $mensagem = "<p style='color:red; text-align:center;'>Erro ao inserir: " . $erro->getMessage() . "</p>";
    }
}
?>

<h2>Cadastrar Novo Produto</h2>

<?= $mensagem ?>

<form method="POST" action="cadastro.php">
    <input type="text" name="nome" placeholder="Nome do Produto" required>
    <input type="text" name="fabricante" placeholder="Fabricante" required>
    <input type="number" step="0.01" name="preco" placeholder="Preço (Ex: 15.30)" required>
    <input type="number" name="estoque" placeholder="Quantidade em Estoque" required>
    <button type="submit">Cadastrar</button>
</form>

<?php require_once 'includes/footer.php'; ?>