<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>

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

    <h2>Editar Produto</h2>

    <?php
    require(__DIR__ . '/config/conexao.php');

    if (isset($_POST['buscar'])) {
        $id = $_POST['id'];

        $sql = "SELECT * FROM produtos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($produto) {
    ?>

    <div class="card">
        <form method="POST">

            <input type="hidden" name="id" value="<?= $produto['id'] ?>">

            <label>Nome:</label>
            <input type="text" name="nome" value="<?= $produto['nome'] ?>">

            <label>Preço:</label>
            <input type="text" name="preco" value="<?= $produto['preco'] ?>">

            <label>Estoque:</label>
            <input type="text" name="estoque" value="<?= $produto['estoque'] ?>">

            <label>Fabricante:</label>
            <input type="text" name="fabricante" value="<?= $produto['fabricante'] ?>">

            <label>Dose:</label>
            <input type="text" name="dose" value="<?= $produto['dose'] ?>">

            <button type="submit" name="salvar">
                Salvar
            </button>

        </form>
    </div>

    <?php
        } else {
            echo "<p>ID não encontrado</p>";
        }
    }

    if (isset($_POST['salvar'])) {

        $sql = "UPDATE produtos SET
            nome = :nome,
            preco = :preco,
            estoque = :estoque,
            fabricante = :fabricante,
            dose = :dose
            WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':id' => $_POST['id'],
            ':nome' => $_POST['nome'],
            ':preco' => $_POST['preco'],
            ':estoque' => $_POST['estoque'],
            ':fabricante' => $_POST['fabricante'],
            ':dose' => $_POST['dose']
        ]);

        echo "<p>Produto atualizado!</p>";
    }
    ?>

    <div class="card">
        <form method="POST">

            <h3>Digite o ID para editar</h3>

            <input type="number" name="id" required>

            <button type="submit" name="buscar">
                Buscar
            </button>

        </form>
    </div>

</main>

<?php require('includes/footer.php'); ?>

</body>
</html>