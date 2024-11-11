<?php
require_once "conn.php";
include_once "estilo\header.html";
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-center">
    <a class="navbar-brand" href="#">
        <img src="imagens\calves.png" alt="Logo" class="navbar-logo"> <!-- Logo -->
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="cadastro\cadastro.php">Cadastro</a></li>
            <li class="nav-item"><a class="nav-link" href="#form">Editar</a></li>
        </ul>
    </div>
</nav>

<!-- Carrossel de Imagens -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="imagens\fundo.jpg" alt="Casa 1">
        </div>
        <div class="carousel-item">
            <img src="imagens\fundo2.jpg" alt="Casa 2">
        </div>
        <div class="carousel-item">
            <img src="imagens\fundo3.jpg" alt="Casa 3">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>

<!-- FILTROS -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center mb-4">Encontre o seu imóvel ideal:</h3>
            <form class="row g-3 d-flex justify-content-center" id="form">
                <div class="col-md-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <select class="form-select" id="cidade">
                        <option value="sao-paulo">São Paulo</option>
                        <option value="rio-de-janeiro">Rio de Janeiro</option>
                        <option value="rio-grande-do-sul">Rio Grande do Sul</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="valorMinimo" class="form-label">Valor Mínimo</label>
                    <input type="number" class="form-control" id="valorMinimo" placeholder="R$">
                </div>
                <div class="col-md-3">
                    <label for="valorMaximo" class="form-label">Valor Máximo</label>
                    <input type="number" class="form-control" id="valorMaximo" placeholder="R$">
                </div>
                <div class="col-md-3">
                    <label for="metragem" class="form-label">Metragem</label>
                    <select class="form-select" id="metragem">
                        <option value="maior-que-80m2">Maior que 80m²</option>
                        <option value="maior-que-120m2">Maior que 120m²</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-center justify-content-center">
                    <a href="consulta.html" class="btn btn-primary w-100">Pesquisar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h1 class="text-center mb-4">Imóveis Disponíveis</h1>

    <div class="row">
        <?php
            // Consultando os imóveis
            $sql = "SELECT id_imovel, cidade, bairro, rua, preco, descricao, nome, telefone, email FROM imoveis";
            $result = $conn->query($sql);

            // Exibindo os imóveis em cards
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
                    echo "<a href='imovel.php?id=" . $row['id_imovel'] . "' class='btn btn-primary'>Editar</a>";
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

<!-- Footer -->
<footer class="bg-dark text-white text-center py-4 mt-5">
    <p>&copy; 2024 Imobiliária Calves. Todos os direitos reservados.</p>
    <p><a href="privacy.html" class="text-white">Política de Privacidade</a> | <a href="terms.html"
            class="text-white">Termos de Uso</a></p>
</footer>