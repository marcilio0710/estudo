<?php
session_start();
$conn = new mysqli("localhost", "root", "", "testes");

$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];

$sql = "SELECT * FROM usuarios WHERE email = ? AND data_nascimento = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $data_nascimento);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['email_recuperacao'] = $email;
    header("Location: nova_senha.php");
} else {
    echo "E-mail ou data de nascimento incorretos.";
}
?>
