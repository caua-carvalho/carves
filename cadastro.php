<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Imóvel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function formatarTelefone(input) {
            let telefone = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos
            if (telefone.length > 11) telefone = telefone.slice(0, 11); // Limita a 11 dígitos
            // Adiciona máscara (XX) XXXXX-XXXX
            if (telefone.length > 6) {
                input.value = `(${telefone.slice(0, 2)}) ${telefone.slice(2, 7)}-${telefone.slice(7)}`;
            } else if (telefone.length >= 2) {
                input.value = `(${telefone.slice(0, 2)}) ${telefone.slice(2)}`;
            } else {
                input.value = telefone;
            }
        }
    </script>
</head>
<body>
    <!-- Navbar -->
    <?php include_once "componentes/navbar.php"; ?>

    <!-- Formulário de Cadastro de Imóvel -->
    <div class="container mt-5">
        <h2>Cadastro de Imóvel</h2>
        <form action="cadastrar_imovel.php" method="POST">
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco" required>
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" class="form-control" id="preco" name="preco" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
            </div>
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
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Sucesso!</h5>
                </div>
                <div class="modal-body">
                    O imóvel foi cadastrado com sucesso!
                </div>
                <div class="modal-footer">
                    <a href="cadastro.php">
                        <button type="button" class="btn btn-primary">OK</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluindo o JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script PHP para exibir o modal após o cadastro bem-sucedido -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <script>
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    </script>
    <?php endif; ?>
</body>
</html>
