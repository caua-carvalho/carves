<?php
require_once "../conn.php";

$id = $_GET['id'];

// Consultando o imóvel pelo ID
$sql = "SELECT cidade, bairro, rua, preco, descricao, nome, telefone, email FROM imoveis WHERE id_imovel = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {    
    $imovel = $result->fetch_assoc();
} else {
    echo "Imóvel não encontrado.";
    exit;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imobiliária - Casa à Venda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include_once "../componentes/navbar_update.php"; ?>

<div class="container my-5">
    <form action="imovel_update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <!-- Detalhes do Imóvel -->
        <div class="row">
            <div class="col-md-6">
                <img src="../imagens/img_01.jpg" alt="Casa à venda" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço</label>
                    <div class="d-flex"s>   
                    <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $imovel['cidade']; ?>">
                    <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $imovel['bairro']; ?>">
                    <input type="text" class="form-control" id="rua" name="rua" value="<?php echo $imovel['rua']; ?>">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" class="form-control" id="preco" name="preco" value="<?php echo $imovel['preco']; ?>">
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="4"><?php echo $imovel['descricao']; ?></textarea>
                </div>
            </div>
        </div>

        <hr>

        <!-- Informações de Contato -->
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Contato</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $imovel['nome']; ?>">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $imovel['telefone']; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $imovel['email']; ?>">
        </div>
        
        <!-- Botão de envio -->
        <button type="submit" class="btn btn-success mt-3">Salvar Modificações</button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include_once "../componentes/modal_update.php"; ?>

</body>
</html>
