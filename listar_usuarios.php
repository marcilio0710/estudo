<?php
$conexao = mysqli_connect("localhost", "root", "", "testes");

if (!$conexao) {
    die("Erro na conexão com o banco.");
}

$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexao, $sql);

echo "<h2>Usuários cadastrados:</h2>";
echo "<ul>";
while ($linha = mysqli_fetch_assoc($resultado)) {
    echo "<li>Email: " . $linha['email'] . "</li>";
}
echo "</ul>";

mysqli_close($conexao);
?>