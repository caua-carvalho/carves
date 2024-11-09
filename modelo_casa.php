<?php
require_once "conn.php";

// Obtendo o ID do imóvel pela URL
$id = $_GET['id'];

// Consultando o imóvel pelo ID
$sql = "SELECT endereco, preco, descricao, nome, telefone, email FROM imoveis WHERE id_imovel = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Verificando se o imóvel foi encontrado
if ($result->num_rows > 0) {    
    $imovel = $result->fetch_assoc();
} else {
    echo "Imóvel não encontrado.";
    exit;
}

// Fechando a conexão
$stmt->close();
$conn->close();


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imobiliária - Casa à Venda</title>
    <!-- Link do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    p {
        font-size: 23px;
    }
    footer {
        background-color: #f8f9fa;
        padding: 20px;
        text-align: center;
        margin-top: 30px;
        border-top: 1px solid #ddd;
    }
    footer p {
        margin: 5px 0;
        display: inline-block;
        margin-right: 20px;
    }
    footer h4 {
        margin-bottom: 10px;
    }
</style>
<body>

    <div class="container my-5">
        <div class="row">
            <!-- Imagem da casa -->
            <div class="col-md-6">
                <img src="https://via.placeholder.com/600x400" alt="Casa à venda" class="img-fluid rounded">
            </div>

            <!-- Informações do imóvel -->
            <div class="col-md-6">
                <h2><?php echo $imovel['endereco']; ?></h2>
                <p><strong>Endereço:</strong><?php echo $imovel['endereco']; ?></p>
                <p><strong>Preço:</strong><?php echo $imovel['preco']; ?></p>
                <p><strong>Descrição:</strong></p>
                <p><?php echo $imovel['descricao']; ?>d</p>
            </div>
        </div>

        <hr>

        <!-- Galeria de imagens -->
        <h3>Galeria de Imagens</h3>
        <div class="row">
            <div class="col-md-4">
                <img src="https://via.placeholder.com/400x300" alt="Imagem 1" class="img-fluid rounded mb-4">
            </div>
            <div class="col-md-4">
                <img src="https://via.placeholder.com/400x300" alt="Imagem 2" class="img-fluid rounded mb-4">
            </div>
            <div class="col-md-4">
                <img src="https://via.placeholder.com/400x300" alt="Imagem 3" class="img-fluid rounded mb-4">
            </div>
        </div>

        <!-- Mais imagens -->
        <div class="row">
            <div class="col-md-4">
                <img src="https://via.placeholder.com/400x300" alt="Imagem 4" class="img-fluid rounded mb-4">
            </div>
            <div class="col-md-4">
                <img src="https://via.placeholder.com/400x300" alt="Imagem 5" class="img-fluid rounded mb-4">
            </div>
            <div class="col-md-4">
                <img src="https://via.placeholder.com/400x300" alt="Imagem 6" class="img-fluid rounded mb-4">
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer>
        <h4>Informações do Corretor</h4>
        <p><strong>Nome:</strong><?php echo $imovel['nome']; ?></p>
        <p><strong>Telefone:</strong><?php echo $imovel['telefone']; ?></p>
        <p><strong>Email:</strong> <?php echo $imovel['email']; ?></p>
    </footer>

    <!-- Link do Bootstrap JavaScript (necessário para algumas funcionalidades como o modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
