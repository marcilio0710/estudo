<?php
session_start();

$conexao = mysqli_connect("localhost", "root", "", "testes");

if (!$conexao) {
    die("Erro na conexão com o banco.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email']) && isset($_POST['senha'])) {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    // Consulta ao banco de dados para buscar o usuário
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

        // Verifica se a senha fornecida corresponde ao hash armazenado no banco
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['sobrenome'] = $usuario['sobrenome'];
            $_SESSION['nascimento'] = $usuario['nascimento'];

            echo "<script>alert('Login realizado com sucesso!'); window.location.href='home.php';</script>";
        } else {
            echo "<script>alert('E-mail ou senha incorretos!'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('E-mail ou senha incorretos!'); window.location.href='login.html';</script>";
    }
}
?>