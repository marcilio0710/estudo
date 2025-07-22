<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['nome'] . ' ' . $_SESSION['sobrenome']; ?>!</h1>

    <!-- Botão de sair com nome -->
    <a href="logout.php">Sair (<?php echo $_SESSION['nome']; ?>)</a>
</body>
</html>
