<?php
require_once "conn.php";
include_once "header.html";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Imóveis Disponíveis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once "componentes/navbar.php"; ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Imóveis Disponíveis</h1>
        
        <div class="row">
            <?php
            // Consultando os imóveis
            $sql = "SELECT id_imovel, endereco, preco, descricao, nome, telefone, email FROM imoveis";
            $result = $conn->query($sql);

            // Exibindo os imóveis em cards
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card h-100'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $row['endereco'] . "</h5>";
                    echo "<p class='card-text'>Preço: R$ " . number_format($row['preco'], 2, ',', '.') . "</p>";
                    echo "<p class='card-text'>Descrição: " . $row['descricao'] . "</p>";
                    echo "<p class='card-text'><strong>Contato:</strong> " . $row['nome'] . "<br>";
                    echo "Telefone: " . $row['telefone'] . "<br>";
                    echo "Email: " . $row['email'] . "</p>";
                    echo "<a href='modelo_casa.php?id=" . $row['id_imovel'] . "' class='btn btn-primary'>Ver detalhes</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='text-center'>Nenhum imóvel encontrado.</p>";
            }

            // Fechando a conexão
            $conn->close();
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
