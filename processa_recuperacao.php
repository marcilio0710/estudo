<?php
// Exibir todos os erros para debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inicia sessão
session_start();

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "testes");

// Verifica conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verifica se os dados foram enviados via POST
if (isset($_POST['email'], $_POST['data_nascimento'])) {
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];

    // Prepara a consulta
    $sql = "SELECT * FROM usuarios WHERE email = ? AND data_nascimento = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar a query: " . $conn->error);
    }

    // Liga os parâmetros e executa
    $stmt->bind_param("ss", $email, $data_nascimento);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se encontrou o usuário
    if ($result && $result->num_rows > 0) {
        $_SESSION['email_recuperacao'] = $email;
        header("Location: nova_senha.php");
        exit;
    } else {
        echo "<script>alert('E-mail ou data de nascimento incorretos!'); window.location.href='recuperar_senha.html';</script>";
        exit;
    }
} else {
    echo "<script>alert('Preencha todos os campos.'); window.location.href='recuperar_senha.html';</script>";
    exit;
}
?>
