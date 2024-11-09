<?php
require_once "conn.php";
// Obtendo os dados do formulário
$endereco = $_POST['endereco'];
$preco = $_POST['preco'];
$descricao = $_POST['descricao'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

$telefone = str_replace(" ", "", $telefone);
$telefone = str_replace("-", "", $telefone);
$telefone = str_replace("(", "", $telefone);
$telefone = str_replace(")", "", $telefone);

// Inserindo os dados no banco de dados
$sql = "INSERT INTO imoveis (endereco, preco, descricao, nome, telefone, email) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sissss", $endereco, $preco, $descricao, $nome, $telefone, $email);

if ($stmt->execute()) {
    // Redireciona para index.php com o parâmetro de sucesso
    header("Location: cadastro.php?success=1");
    exit();
} else {
    echo "Erro ao cadastrar o imóvel: " . $conn->error;
}

// Fechando a conexão
$stmt->close();
$conn->close();
?>
