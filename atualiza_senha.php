<?php
session_start();
if (!isset($_SESSION['email_recuperacao'])) {
    echo "Sessão expirada. Tente novamente.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "testes");
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$email = $_SESSION['email_recuperacao'];
$nova_senha = password_hash($_POST['nova_senha'], PASSWORD_DEFAULT);

$sql = "UPDATE usuarios SET senha = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nova_senha, $email);

if ($stmt->execute()) {
    unset($_SESSION['email_recuperacao']);
    echo "<script>alert('Senha atualizada com sucesso!'); window.location.href='login.html';</script>";
} else {
    echo "Erro ao atualizar a senha.";
}
?>
