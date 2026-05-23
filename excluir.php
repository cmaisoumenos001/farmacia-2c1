<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Produtos</title>

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
    <h2>Excluir Produto</h2>

    <?php
    require(__DIR__ . '/config/conexao.php');

 
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        echo "<p>Produto com ID $id excluído</p>";
    }
    ?>


    <form method="POST">
        <label>Digite o ID:</label>
        <input type="number" name="id" required>
        <button type="submit">Excluir</button>
    </form>

    <hr>

    <h3>Lista de Produtos</h3>

    <?php

    $sql = "SELECT * FROM produtos";
    $stmt = $pdo->query($sql);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<p>";
        echo "ID: " . $row['id'] . " | ";
        echo "Nome: " . $row['nome'] . " | ";
        echo "Preço: " . $row['preco'];
        echo "</p>";
    }
    ?>
</div>

</body>
</html>