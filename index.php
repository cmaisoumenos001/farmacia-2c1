<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmacia</title>

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

<div class="content">
    <h2>Lista de Produtos</h2>

    <?php
    require('config/conexao.php');

    $sql = "SELECT * FROM produtos";
    $stmt = $pdo->query($sql);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<p>";
        echo "ID: " . $row['id'] . " | ";
        echo "Nome: " . $row['nome'] . " | ";
        echo "Preço: " . $row['preco'] . " | ";
        echo "Estoque: " . $row['estoque'] . " | ";
        echo "Fabricante: " . $row['fabricante'] . " | ";
        echo "Dose: " . $row['dose'];
        echo "</p>";
    }
    ?>
</div>
<?php require('includes/footer.php'); ?>
</body>

</body>
</html>