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
        <a href="editar.php" class="active">Editar</a>
        <a href="excluir.php">Excluir</a>
    </nav>
</header>

<main>

    <h2>Editar Produto</h2>

    <?php
    require(__DIR__ . '/config/conexao.php');

    if (isset($_POST['salvar'])) {

        $sql = "UPDATE produtos SET
                    nome       = :nome,
                    preco      = :preco,
                    estoque    = :estoque,
                    fabricante = :fabricante,
                    dose       = :dose
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':id'         => $_POST['id'],
            ':nome'       => $_POST['nome'],
            ':preco'      => $_POST['preco'],
            ':estoque'    => $_POST['estoque'],
            ':fabricante' => $_POST['fabricante'],
            ':dose'       => $_POST['dose']
        ]);

        echo "<div class='msg'>✓ Produto ID <strong>{$_POST['id']}</strong> atualizado com sucesso!</div>";
    }

    if (isset($_POST['buscar'])) {
        $id = $_POST['id'];

        $sql  = "SELECT * FROM produtos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>

    <?php if (isset($produto) && $produto): ?>

    <div class="form-wrapper">
        <div class="form-box">
            <h3>Editando: <?= htmlspecialchars($produto['nome']) ?></h3>

            <form method="POST">
                <input type="hidden" name="id" value="<?= $produto['id'] ?>">

                <div>
                    <label>Nome</label>
                    <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
                </div>

                <div>
                    <label>Preço (R$)</label>
                    <input type="text" name="preco" value="<?= $produto['preco'] ?>" required>
                </div>

                <div>
                    <label>Estoque</label>
                    <input type="number" name="estoque" value="<?= $produto['estoque'] ?>" required>
                </div>

                <div>
                    <label>Fabricante</label>
                    <input type="text" name="fabricante" value="<?= htmlspecialchars($produto['fabricante']) ?>" required>
                </div>

                <div>
                    <label>Dose</label>
                    <input type="text" name="dose" value="<?= htmlspecialchars($produto['dose']) ?>" required>
                </div>

                <button type="submit" name="salvar">Salvar Alterações</button>

            </form>
        </div>
    </div>

    <?php elseif (isset($_POST['buscar']) && !$produto): ?>
        <div class="msg erro">✗ Nenhum produto encontrado com o ID informado.</div>
    <?php endif; ?>

    <div class="form-wrapper">
        <div class="form-box">
            <h3>Buscar pelo ID</h3>

            <form method="POST">
                <div>
                    <label>ID do Produto</label>
                    <input type="number" name="id" placeholder="Ex: 1" required>
                </div>
                <button type="submit" name="buscar" class="btn-dark">Buscar Produto</button>
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