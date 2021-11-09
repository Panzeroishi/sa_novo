<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $flag = 1;
    $id = $nome = $logradouro = $cidade = $sexo = '';
    if (isset($_POST['submit'])) {
        //receber e validar os dados do post
        $nome = trim($_POST['nome']);
        $logradouro = trim($_POST['logradouro']);
        $cidade = trim($_POST['cidade']);
        $sexo = trim($_POST['sexo']);
        //conectar ao banco
        $con = new mysqli('localhost', 'root', 'root', 'imersao');
        if ($con->connect_error) {
            echo "Não foi possível estabelecer conexão! Erro: " . $con->connect_error;
        }
        //criar a query
        $query = "INSERT INTO pessoa(id, nome, logradouro, cidade, sexo) 
                    VALUES(null, '$nome', '$logradouro', '$cidade', '$sexo')";
        //executar a query
        $resultado = $con->query($query);

        //validar o resultado
        if ($resultado) {
            echo "Dados inseridos com sucesso";
            $nome = $logradouro = $cidade = $sexo = "";
        } else {
            echo "Não foi possível inserir os dados! Erro: " . $con->error;
        }
        //fechar a conexão
        $con->close();
    } elseif (isset($_POST['pesquisar'])) {
        $flag = 0;
        //receber e validar os dados do post
        $id = trim($_POST['id']);
        //conectar ao banco
        $con = new mysqli('localhost', 'root', 'root', 'imersao');
        if ($con->connect_error) {
            echo "Não foi possível estabelecer conexão! Erro: " . $con->connect_error;
        }
        //criar a query
        $query = "SELECT * FROM pessoa WHERE id = $id";

        //executar a query
        $resultado = $con->query($query);
        //validar o resultado
        if ($resultado->num_rows) {
            foreach ($resultado as $value) {
                foreach ($value as $key => $v) {

                    $$key = $v;
                }
            }
        } else {
            echo "Nenhum dado foi encontrado!";
            $flag = 1;
        }
        //fechar a conexão
        $con->close();
    } elseif (isset($_POST['alterar'])) {
        //receber e validar os dados do post
        $id = trim($_POST['id']);
        $nome = trim($_POST['nome']);
        $logradouro = trim($_POST['logradouro']);
        $cidade = trim($_POST['cidade']);
        $sexo = trim($_POST['sexo']);
        //conectar ao banco
        $con = new mysqli('localhost', 'root', 'root', 'imersao');
        if ($con->connect_error) {
            echo "Não foi possível estabelecer conexão! Erro: " . $con->connect_error;
        }
        //criar a query
        $query = "UPDATE pessoa SET nome='$nome', logradouro = '$logradouro', 
        cidade = '$cidade', sexo = '$sexo' WHERE id = $id";
        //executar a query
        $resultado = $con->query($query);
        //validar o resultado
        if ($resultado) {
            echo "Dados atualizados com sucesso!";
            $id = $nome = $logradouro = $cidade = $sexo = '';
        } else {
            echo "Não foi possível atualizar os dados!";
        }
        //fechar a conexão
        $con->close();
    } elseif (isset($_POST['deletar'])) {
        //receber e validar os dados do post
        $id = trim($_POST['id']);
        //conectar ao banco
        $con = new mysqli('localhost', 'root', 'root', 'imersao');
        if ($con->connect_error) {
            echo "Não foi possível estabelecer conexão! Erro: " . $con->connect_error;
        }
        //criar a query
        $query = "DELETE FROM pessoa WHERE id = $id";
        //executar a query
        $resultado = $con->query($query);
        //validar o resultado
        if ($resultado) {
            echo "Dados excluídos com sucesso!";
            $id = $nome = $logradouro = $cidade = $sexo = '';
        } else {
            echo "Não foi possível fazer a exclusão!";
        }
        //fechar a conexão
        $con->close();
    } elseif (isset($_POST['limpa_tudo'])) {
    }
    ?>
    <form action="#" method="post">
        <input type="text" name="id" id="id">
        <input type="submit" name="pesquisar" value="Pesquisar"><br><br>
    </form>
    <form action="#" method="post">
        Id <input type="text" name="id" id="id" size="4" readonly value="<?= $id ?>">
        Nome: <input type="text" name="nome" id="nome" value="<?= $nome ?>"><br>
        Logradouro: <input type="text" name="logradouro" id="logradouro" value="<?= $logradouro ?>"><br>
        Cidade: <input type="text" name="cidade" id="cidade" value="<?= $cidade ?>"><br>
        Sexo:<br> <input type="radio" name="sexo" id="sexo" value="masculino" checked>Masculino<br>
        <input type="radio" name="sexo" id="sexo" value="feminino" <?= $sexo === 'feminino' ? 'checked' : '' ?>>Feminino<br>
        <input type="radio" name="sexo" id="sexo" value="outro" <?= $sexo === 'outro' ? 'checked' : '' ?>>Outro<br>
        <input type="submit" name="submit" value="Enviar" <?= $flag == 0 ? "disabled='disabled'" : ''  ?>>
        <input type="submit" name="alterar" value="Alterar" <?= $flag == 1 ? "disabled='disabled'" : ''  ?>>
        <input type="submit" name="deletar" value="Deletar" <?= $flag == 1 ? "disabled='disabled'" : ''  ?>>
        <input type="submit" name="limpa_tudo" value="Limpar">
    </form>

</body>

</html>