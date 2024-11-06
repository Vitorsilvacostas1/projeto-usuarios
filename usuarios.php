<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro de Usuários</h2>
        <form action="usuarios.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <button type="submit">Cadastrar</button>
        </form>
        
        <a href="index.php" class="back-button">Voltar</a> <!-- Botão de voltar -->

        <?php
        // aqui faz a Conexão com o banco de dados e inserção de dados
        $conn = new mysqli('localhost', 'root', '', 'PROPRIEDADE');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $stmt = $conn->prepare("INSERT INTO TBL_USUARIOS (USU_NOME, USU_EMAIL) VALUES (?, ?)");
            $stmt->bind_param("ss", $nome, $email);
            $stmt->execute();
            echo "Usuário cadastrado com sucesso!";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
