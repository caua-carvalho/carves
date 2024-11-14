<?php
require_once "../conn.php";

// Verificação dos dados enviados
var_dump($_POST);

$id = $_POST['id'];
if (empty($id)) {
    echo "ID do imóvel não fornecido.";
    exit;
}

$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$rua = $_POST['rua'];
$preco = $_POST['preco'];
$descricao = $_POST['descricao'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

// Atualizando os dados do imóvel
$sql = "UPDATE imoveis SET cidade=?, bairro=?, rua=?, preco=?, descricao=?, nome=?, telefone=?, email=? WHERE id_imovel=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdssssi", $cidade, $bairro, $rua, $preco, $descricao, $nome, $telefone, $email, $id);

if ($stmt->execute()) {
    header("Location: ../index.php?success=1");
} else {
    echo "Erro ao atualizar o imóvel.";
}

$stmt->close();
$conn->close();
?>
