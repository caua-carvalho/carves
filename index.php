<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Imóveis Disponíveis</title>
</head>
<body>
    <h1>Imóveis disponíveis</h1>

    <?php
    // Conectar ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = ""; // Insira a senha do seu banco de dados, se houver
    $dbname = "carves";

    // Criando a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificando a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Consultando os imóveis
    $sql = "SELECT id_imovel, endereco, preco, descricao, nome, telefone, email FROM imoveis";
    $result = $conn->query($sql);

    // Exibindo os imóveis em cards
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px;'>";
            echo "<h2>Endereço: " . $row['endereco'] . "</h2>";
            echo "<p>Preço: R$ " . number_format($row['preco'], 2, ',', '.') . "</p>";
            echo "<p>Descrição: " . $row['descricao'] . "</p>";
            echo "<p>Contato: " . $row['nome'] . " - Telefone: " . $row['telefone'] . " - Email: " . $row['email'] . "</p>";
            echo "<a href='imovel.php?id=" . $row['id_imovel'] . "'>Ver detalhes</a>";
            echo "</div>";
        }
    } else {
        echo "Nenhum imóvel encontrado.";
    }

    // Fechando a conexão
    $conn->close();
    ?>

</body>
</html>
