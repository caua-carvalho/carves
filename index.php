<?php
require_once "conn.php";
include_once "./estilo/header.html";

?>

<!-- Navbar -->
<?php include_once "./componentes/navbar.php"; ?>

<!-- Carrossel de Imagens -->


<!-- FILTROS -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center mb-4">Encontre o seu imóvel ideal:</h3>
            <form class="row g-3 d-flex justify-content-center" id="form" method="GET" action="">
                <div class="col-md-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <?php include_once "./componentes/select_cidade.php"; ?>
                </div>
                <div class="col-md-3">
                    <label for="valorMinimo" class="form-label">Valor Mínimo</label>
                    <input type="number" class="form-control" id="valorMinimo" name="valorMinimo" placeholder="R$">
                </div>
                <div class="col-md-3">
                    <label for="valorMaximo" class="form-label">Valor Máximo</label>
                    <input type="number" class="form-control" id="valorMaximo" name="valorMaximo" placeholder="R$">
                </div>
                <div class="col-md-3">
                    <label for="metragem" class="form-label">Metragem</label>
                    <select class="form-select" id="metragem" name="metragem">
                        <option value="">Selecione</option>
                        <option value="maior-que-80m2">Maior que 80m²</option>
                        <option value="maior-que-120m2">Maior que 120m²</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary w-100">Pesquisar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h1 class="text-center mb-4">Imóveis Disponíveis</h1>

    <div class="row">
        <?php
            // Construindo a consulta SQL com filtros dinâmicos
            $sql = "SELECT id_imovel, cidade, bairro, rua, preco, descricao, nome, telefone, email FROM imoveis WHERE 1=1";
            
            if (!empty($_GET['cidade'])) {
                $cidade = $_GET['cidade'];
                $sql .= " AND cidade = '$cidade'";
            }
            if (!empty($_GET['valorMinimo'])) {
                $valorMinimo = (float) $_GET['valorMinimo'];
                $sql .= " AND preco >= $valorMinimo";
            }
            if (!empty($_GET['valorMaximo'])) {
                $valorMaximo = (float) $_GET['valorMaximo'];
                $sql .= " AND preco <= $valorMaximo";
            }
            if (!empty($_GET['metragem'])) {
                $metragem = $_GET['metragem'];
                if ($metragem == "maior-que-80m2") {
                    $sql .= " AND metragem > 80";
                } elseif ($metragem == "maior-que-120m2") {
                    $sql .= " AND metragem > 120";
                }
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card h-100'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $row['cidade'] . ", " .  $row['bairro'] . ", " . $row['rua'] . "</h5>";
                    echo "<p class='card-text'>Preço: R$ " . number_format($row['preco'], 2, ',', '.') . "</p>";
                    echo "<p class='card-text'>Descrição: " . $row['descricao'] . "</p>";
                    echo "<p class='card-text'><strong>Contato:</strong> " . $row['nome'] . "<br>";
                    echo "Telefone: " . $row['telefone'] . "<br>";
                    echo "Email: " . $row['email'] . "</p>";
                    echo "<a href='./update/imovel.php?id=" . $row['id_imovel'] . "' class='btn btn-primary'>Editar</a> ";
                    echo "<a href='./delete/delete_imovel.php?id=" . $row['id_imovel'] . "' class='btn btn-danger' onclick=\"return confirm('Tem certeza que deseja excluir este imóvel?')\">Excluir</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='text-center'>Nenhum imóvel encontrado.</p>";
            }
            

            $conn->close();
        ?>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-4 mt-5">
    <p>&copy; 2024 Imobiliária Calves. Todos os direitos reservados.</p>
    <p><a href="privacy.html" class="text-white">Política de Privacidade</a> | <a href="terms.html"
            class="text-white">Termos de Uso</a></p>
</footer>