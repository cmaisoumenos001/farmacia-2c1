<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="sidebar">
    <h2>Menu</h2>
    <a href="index.php">Home</a>
    <a href="cadastro.php">Cadastro</a>
    <a href="excluir.php">Excluir</a>
    <a href="editar.php">Editar</a>
</div>



<form method="post">
    <label>Nome do Produto</label>
    <input type="text" name="nome" required>
    <br><br>
    <label>Preço</label>
    <input type="text" name="preco" required>
    <br><br>
    <label>Fabricante</label>
    <input type="text" name="fabricante" required>
    <br><br>
    <label>estoque</label>
    <input type="text" name="estoque" required>
    <br><br>
    <label>dose do Produto</label>
    <input type="text" name="dose" required>
    <br><br>
    <button type="submit">enviar</button>

</form>

<?php
require ('<config/conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$nome = $_POST['nome'];
$preco = $_POST['preco'];
$fabricante = $_POST['fabricante'];
$estoque = $_POST['estoque'];
$dose = $_POST['dose'];




$sql = "INSERT INTO produtos (nome, preco, fabricante, estoque, dose) VALUES (:nome, :preco, :fabricante, :estoque, :dose)";
$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':nome' => $nome,
    ':preco' => $preco,
    ':fabricante' => $fabricante,
    ':estoque' => $estoque,
    ':dose' => $dose
]);

$id = $pdo->lastInsertId();


 echo $id . " ". $nome . " " . $preco . " " . $fabricante . " " . $estoque; 
}
?>
<br>
</body>
</html>