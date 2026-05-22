<?php
$servidor = "127.0.0.1";
$banco = "farmacia";
$usuario = "root";
$senha = "";

try {
    $pdo = new PDO(
        "mysql:host=$servidor;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha
    );
    // Configura o PDO para lançar exceções em caso de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $erro) {
    echo "A conexão não pôde ser realizada: " . $erro->getMessage();
    exit;
}
?>