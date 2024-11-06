<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro de Tarefas</h2>
        <form action="tarefas.php" method="POST">
            <label for="setor">Setor:</label>
            <input type="text" name="setor" required>
            
            <label for="prioridade">Prioridade:</label>
            <input type="text" name="prioridade" required>
            
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" required>

            <label for="status">Status:</label>
            <select name="status" required>
                <option value="">Escolher...</option>
                <option value="A Fazer">A Fazer</option>
                <option value="Fazendo">Fazendo</option>
                <option value="Pronto">Pronto</option>
            </select>
            
            <button type="submit">Cadastrar</button>
        </form>
        
        <a href="index.php" class="back-button">Voltar</a> <!-- Botão de voltar -->

        <?php
        // Conexão com o banco de dados e inserção de dados
        $conn = new mysqli('localhost', 'root', '', 'PROPRIEDADE');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $setor = $_POST['setor'];
            $prioridade = $_POST['prioridade'];
            $descricao = $_POST['descricao'];
            $status = $_POST['status'];

            // Verifica se todos os campos estão preenchidos, incluindo o status
            if (empty($setor) || empty($prioridade) || empty($descricao) || empty($status)) {
                echo "Por favor, preencha todos os campos.";
            } else {
                $stmt = $conn->prepare("INSERT INTO TBL_TAREFA (TAR_SETOR, TAR_PRIORIDADE, TAR_DESCRICAO, TAR_STATUS) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $setor, $prioridade, $descricao, $status);
                $stmt->execute();
                echo "Tarefa cadastrada com sucesso!";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
