<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Produto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Farmácia</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="cadastro.php">Cadastro</a>
        <a href="editar.php">Editar</a>
        <a href="excluir.php" class="active">Excluir</a>
    </nav>
</header>

<main>

    <h2>Excluir Produto</h2>

    <?php
    require(__DIR__ . '/config/conexao.php');

    if (isset($_POST['id'])) {

        $id = $_POST['id'];

        $sql  = "DELETE FROM produtos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        if ($stmt->rowCount() > 0) {
            echo "<div class='msg'>✓ Produto com ID <strong>$id</strong> excluído com sucesso!</div>";
        } else {
            echo "<div class='msg erro'>✗ Nenhum produto encontrado com o ID <strong>$id</strong>.</div>";
        }
    }
    ?>

    <div class="form-wrapper">
        <div class="form-box">
            <h3>Excluir pelo ID</h3>

            <form method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este produto?')">

                <div>
                    <label>ID do Produto</label>
                    <input type="number" name="id" placeholder="Ex: 1" required>
                </div>

                <button type="submit" class="btn-dark">Excluir Produto</>

            </form>
        </div>
    </div>

    <div class="section-title">
        <h2>Todos os Produtos</h2>
    </div>

    <div class="cards">

        <?php
        $sql  = "SELECT * FROM produtos";
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>

        <div class="card">
            <span class="badge-id">ID <?= $row['id'] ?></span>
            <h2><?= htmlspecialchars($row['nome']) ?></h2>
            <p><strong>Preço</strong> R$ <?= number_format($row['preco'], 2, ',', '.') ?></p>
            <p><strong>Estoque</strong> <?= $row['estoque'] ?> un.</p>
            <p><strong>Fabricante</strong> <?= htmlspecialchars($row['fabricante']) ?></p>
            <p><strong>Dose</strong> <?= htmlspecialchars($row['dose']) ?></p>
        </div>

        <?php } ?>

    </div>

</main>

<?php require('includes/footer.php'); ?>

</body>
</html>
