<?php
// Incluir a conexão com o banco de dados
include('conn.php');

// Verificando se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pegando os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $localizacao = $_POST['localizacao'];

    // Validando se os dados não estão vazios
    if (!empty($nome) && !empty($descricao) && !empty($preco) && !empty($localizacao)) {
        
        // Preparando a consulta SQL para evitar SQL Injection
        $stmt = $conexao->prepare("INSERT INTO casas (nome, descricao, preco, localizacao) VALUES (?, ?, ?, ?)");
        
        // Vinculando os parâmetros ao statement
        $stmt->bind_param("ssss", $nome, $descricao, $preco, $localizacao);
        
        // Executando a consulta
        if ($stmt->execute()) {
            // Pegando o ID da última casa cadastrada
            $last_id = $stmt->insert_id;
            
            // Criando o conteúdo HTML da página da casa
            $conteudo_html = "
                <html lang='pt-br'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>$nome</title>
                </head>
                <body>
                    <h1>$nome</h1>
                    <p><strong>Descrição:</strong> $descricao</p>
                    <p><strong>Preço:</strong> R$$preco</p>
                    <p><strong>Localização:</strong> $localizacao</p>
                    <a href='/index.php'>Voltar à página inicial</a>
                </body>
                </html>
            ";

            // Caminho do arquivo HTML a ser criado
            $caminho_arquivo = "casas/$last_id.html";

            // Criando o arquivo HTML da casa
            file_put_contents($caminho_arquivo, $conteudo_html);
            
            echo "Casa cadastrada com sucesso! A página pode ser visualizada <a href='/casas/$last_id.html'>aqui</a>.";
        } else {
            echo "Erro ao cadastrar a casa: " . $stmt->error;
        }

        // Fechando a declaração
        $stmt->close();
    } else {
        echo "Por favor, preencha todos os campos!";
    }
}

// Fechando a conexão com o banco
$conexao->close();
?>
