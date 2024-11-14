<?php 
include_once "../estilo/header.html";
require_once "../conn.php"
?>

<title>Cadastro de Imóvel</title>
<head>

</head>

<body>
    <!-- Navbar -->
    <?php include_once "../componentes/navbar.php"; ?>

    <!-- Formulário de Cadastro de Imóvel -->
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <h2>Cadastro de Imóvel</h2>
        </div>

        <br>

        <h4>Informações do imovel</h4>
        
        <form action="cadastrar_imovel.php" method="POST">
            <div class="mb-3">
                <label for="cidade" class="form-label">Cidade</label>
                <select class="form-select" id="cidade" name="cidade" onchange="verificarOutraCidade()">
    <?php
    $sql = "SELECT DISTINCT cidade FROM imoveis";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['cidade'] . "'>" . $row['cidade'] . "</option>";
        }
    }
    ?>
    <option value="outra">outra</option>
</select>

<!-- Campo de input que será exibido para nova cidade -->
<input type="hidden" class="form-control mt-2" id="outraCidade" name="outraCidade" placeholder="Digite o nome da cidade" style="display:none;">

<script>
function verificarOutraCidade() {
    var selectCidade = document.getElementById("cidade");
    var inputOutraCidade = document.getElementById("outraCidade");
    
    if (selectCidade.value === "outra") {
        inputOutraCidade.type = "";
        inputOutraCidade.required = true;
    } else {
        inputOutraCidade.style.display = "none";
        inputOutraCidade.required = false;
    }
}
</script>

            </div>
            <div class="mb-3">
                <label for="bairro" class="form-label">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" required>
            </div>
            <div class="mb-3">
                <label for="rua" class="form-label">Rua</label>
                <input type="text" class="form-control" id="rua" name="rua" required>
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" class="form-control" id="preco" name="preco" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
            </div>
            <br>

            <h4>Informações do Proprietario</h4>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Contato</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" oninput="formatarTelefone(this)" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar Imóvel</button>
        </form>
    </div>

    <!-- Modal de Sucesso -->
    <?php include_once "../componentes/modal_cadastro.php"; ?>
</body>
