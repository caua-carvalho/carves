<?php
require_once "../conn.php";

// Obtendo os dados do formulário
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$rua = $_POST['rua'];
$preco = $_POST['preco'];
$descricao = $_POST['descricao'];
$nome = $_POST['nome'];
$telefone = str_replace([" ", "-", "(", ")"], "", $_POST['telefone']);
$email = $_POST['email'];

// Função para salvar a imagem e retornar o caminho
function salvarImagem($file, $destino) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nomeArquivo = uniqid() . '.' . $ext;
        $caminhoCompleto = $destino . $nomeArquivo;
        move_uploaded_file($file['tmp_name'], $caminhoCompleto);
        return $caminhoCompleto;
    }
    return null;
}

// Definindo o diretório de upload
$destino = '../imagens/';
$imagemPrincipal = salvarImagem($_FILES['imagem_principal'], $destino);
$imagemSecundaria1 = salvarImagem($_FILES['imagem_secundaria_1'], $destino);
$imagemSecundaria2 = salvarImagem($_FILES['imagem_secundaria_2'], $destino);
$imagemSecundaria3 = salvarImagem($_FILES['imagem_secundaria_3'], $destino);

// Inserindo os dados no banco de dados
$sql = "INSERT INTO imoveis (cidade, bairro, rua, preco, descricao, nome, telefone, email, img_main, img_1, img_2, img_3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssissssssss", $cidade, $bairro, $rua, $preco, $descricao, $nome, $telefone, $email, $imagemPrincipal, $imagemSecundaria1, $imagemSecundaria2, $imagemSecundaria3);

if ($stmt->execute()) {
    header("Location: cadastro.php?success=1");
    exit();
} else {
    echo "Erro ao cadastrar o imóvel: " . $conn->error;
}

// Fechando a conexão
$stmt->close();
$conn->close();
?>
