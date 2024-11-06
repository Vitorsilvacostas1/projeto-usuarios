<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Alterar Tarefa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Alterar Tarefa</h2>

        <?php
        $conn = new mysqli('localhost', 'root', '', 'PROPRIEDADE');

        if (isset($_GET['codigo'])) {
            $codigo = $_GET['codigo'];
            $result = $conn->query("SELECT * FROM TBL_TAREFA WHERE TAR_CODIGO = $codigo");
            $tarefa = $result->fetch_assoc();

            if ($tarefa) {
                echo "<form action='alterar_tarefa.php' method='POST'>
                        <input type='hidden' name='codigo' value='{$tarefa['TAR_CODIGO']}'>
                        <label for='setor'>Setor:</label>
                        <input type='text' name='setor' value='{$tarefa['TAR_SETOR']}' required>
                        
                        <label for='prioridade'>Prioridade:</label>
                        <input type='text' name='prioridade' value='{$tarefa['TAR_PRIORIDADE']}' required>
                        
                        <label for='descricao'>Descrição:</label>
                        <input type='text' name='descricao' value='{$tarefa['TAR_DESCRICAO']}' required>
                        
                        <label for='status'>Status:</label>
                        <input type='text' name='status' value='{$tarefa['TAR_STATUS']}' required>
                        
                        <button type='submit'>Salvar Alterações</button>
                      </form>";
            } else {
                echo "<p>Tarefa não encontrada!</p>";
            }
        }

        // Atualização da tarefa no banco de dados
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $codigo = $_POST['codigo'];
            $setor = $_POST['setor'];
            $prioridade = $_POST['prioridade'];
            $descricao = $_POST['descricao'];
            $status = $_POST['status'];

            $stmt = $conn->prepare("UPDATE TBL_TAREFA SET TAR_SETOR = ?, TAR_PRIORIDADE = ?, TAR_DESCRICAO = ?, TAR_STATUS = ? WHERE TAR_CODIGO = ?");
            $stmt->bind_param("ssssi", $setor, $prioridade, $descricao, $status, $codigo);
            $stmt->execute();
            echo "<p>Tarefa atualizada com sucesso!</p>";
            echo "<a href='gerenciar_tarefas.php' class='back-button'>Voltar para Gerenciar Tarefas</a>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
