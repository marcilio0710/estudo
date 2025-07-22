<?php
$conexao = mysqli_connect("localhost", "root", "", "testes");

if (!$conexao) {
    die("Erro na conexão com o banco.");
}

$nome = mysqli_real_escape_string($conexao, $_POST['nome']);
$sobrenome = mysqli_real_escape_string($conexao, $_POST['sobrenome']);
$data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

// Verifica se o e-mail já está cadastrado
$check = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$email'");

if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('E-mail já cadastrado!'); window.location.href='cadastro.html';</script>";
} else {
    // Criptografa a senha antes de salvar no banco
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, sobrenome, data_nascimento, email, senha) 
            VALUES ('$nome', '$sobrenome', '$data_nascimento', '$email', '$senha_hash')";
            
    if (mysqli_query($conexao, $sql)) {
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar!'); window.location.href='cadastro.html';</script>";
    }
}
?>
