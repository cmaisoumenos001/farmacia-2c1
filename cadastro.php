<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>

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

    <h2>Cadastro de Produtos</h2>

    <div class="card">

        <form method="POST">

            <label>Nome do Produto</label>
            <input type="text" name="nome" required>

            <label>Preço</label>
            <input type="text" name="preco" required>

            <label>Fabricante</label>
            <input type="text" name="fabricante" required>

            <label>Estoque</label>
            <input type="text" name="estoque" required>

            <label>Dose do Produto</label>
            <input type="text" name="dose" required>

            <button type="submit">
                Enviar
            </button>

        </form>

    </div>

    <?php
    require('config/conexao.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $fabricante = $_POST['fabricante'];
        $estoque = $_POST['estoque'];
        $dose = $_POST['dose'];

        $sql = "INSERT INTO produtos
        (nome, preco, fabricante, estoque, dose)
        VALUES
        (:nome, :preco, :fabricante, :estoque, :dose)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':nome' => $nome,
            ':preco' => $preco,
            ':fabricante' => $fabricante,
            ':estoque' => $estoque,
            ':dose' => $dose
        ]);

        $id = $pdo->lastInsertId();

        echo "<p>Produto cadastrado com sucesso! ID: $id</p>";
    }
    ?>

</main>

<?php require('includes/footer.php'); ?>

</body>
</html>