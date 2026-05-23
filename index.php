<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmácia</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header>
    <h1>Farmácia</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="cadastro.php">Cadastro</a>
        <a href="editar.php">Editar</a>
        <a href="excluir.php">Excluir</a>
    </nav>
</header>

<main>

    <h2>Lista de Produtos</h2>

    <div class="cards">

        <?php
        require('config/conexao.php');

        $sql = "SELECT * FROM produtos";
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>

        <div class="card">
            <h2><?= $row['nome'] ?></h2>

            <p><strong>ID:</strong> <?= $row['id'] ?></p>
            <p><strong>Preço:</strong> R$ <?= $row['preco'] ?></p>
            <p><strong>Estoque:</strong> <?= $row['estoque'] ?></p>
            <p><strong>Fabricante:</strong> <?= $row['fabricante'] ?></p>
            <p><strong>Dose:</strong> <?= $row['dose'] ?></p>
        </div>

        <?php } ?>

    </div>

</main>

<?php require('includes/footer.php'); ?>

</body>
</html>