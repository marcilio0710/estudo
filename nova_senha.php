<?php
session_start();
if (!isset($_SESSION['email_recuperacao'])) {
    header("Location: recuperar_senha.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Nova Senha</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="container">
    <h1>Digite sua nova senha</h1>
    <form action="atualiza_senha.php" method="POST">
      <input type="password" name="nova_senha" placeholder="Nova senha" required>
      <button type="submit">Atualizar senha</button>
    </form>
  </main>
</body>
</html>
