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
        <a href="cadastro.php" class="active">Cadastro</a>
        <a href="editar.php">Editar</a>
        <a href="excluir.php">Excluir</a>
    </nav>
</header>

<main>

    <h2>Cadastro de Produtos</h2>

    <?php
    require('config/conexao.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nome       = $_POST['nome'];
        $preco      = $_POST['preco'];
        $fabricante = $_POST['fabricante'];
        $estoque    = $_POST['estoque'];
        $dose       = $_POST['dose'];

        $sql = "INSERT INTO produtos (nome, preco, fabricante, estoque, dose)
                VALUES (:nome, :preco, :fabricante, :estoque, :dose)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':nome'       => $nome,
            ':preco'      => $preco,
            ':fabricante' => $fabricante,
            ':estoque'    => $estoque,
            ':dose'       => $dose
        ]);

        $id = $pdo->lastInsertId();

        echo "<div class='msg'>✓ Produto cadastrado com sucesso! ID: <strong>$id</strong></div>";
    }
    ?>

    <div class="form-wrapper">
        <div class="form-box">
            <h3>Novo Produto</h3>

            <form method="POST">

                <div>
                    <label>Nome do Produto</label>
                    <input type="text" name="nome" placeholder="Ex: Paracetamol 500mg" required>
                </div>

                <div>
                    <label>Preço (R$)</label>
                    <input type="text" name="preco" placeholder="Ex: 12.90" required>
                </div>

                <div>
                    <label>Fabricante</label>
                    <input type="text" name="fabricante" placeholder="Ex: EMS" required>
                </div>

                <div>
                    <label>Estoque (unidades)</label>
                    <input type="number" name="estoque" placeholder="Ex: 50" required>
                </div>

                <div>
                    <label>Dose</label>
                    <input type="text" name="dose" placeholder="Ex: 500mg" required>
                </div>

                <button type="submit" class="btn-dark">Cadastrar Produto</button>

            </form>
        </div>
    </div>

</main>

<?php require('includes/footer.php'); ?>

</body>
</html>
