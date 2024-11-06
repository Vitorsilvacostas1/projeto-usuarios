<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Gerenciar Tarefas</h2>

        <?php
        $conn = new mysqli('localhost', 'root', '', 'PROPRIEDADE');

        // Exclusão de tarefa
        if (isset($_GET['excluir'])) {
            $codigo = $_GET['excluir'];
            $conn->query("DELETE FROM TBL_TAREFA WHERE TAR_CODIGO = $codigo");
            echo "<p>Tarefa excluída com sucesso!</p>";
        }

        // Listagem de tarefas
        $result = $conn->query("SELECT * FROM TBL_TAREFA");
        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Setor</th>
                        <th>Prioridade</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['TAR_CODIGO']}</td>
                        <td>{$row['TAR_SETOR']}</td>
                        <td>{$row['TAR_PRIORIDADE']}</td>
                        <td>{$row['TAR_DESCRICAO']}</td>
                        <td>{$row['TAR_STATUS']}</td>
                        <td>
                            <a href='alterar_tarefa.php?codigo={$row['TAR_CODIGO']}' class='edit-button'>Alterar</a>
                            <a href='gerenciar_tarefas.php?excluir={$row['TAR_CODIGO']}' class='delete-button' onclick=\"return confirm('Tem certeza que deseja excluir esta tarefa?');\">Excluir</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhuma tarefa encontrada.";
        }

        $conn->close();
        ?>

        <a href="index.php" class="back-button">Voltar</a> <!-- Botão de voltar -->
    </div>
</body>
</html>
