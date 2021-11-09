        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Home</title>
        </head>
        <body>
            

            <?php

            /* estrutura da API*/
            if(isset($_GET['enviar'])){
                $cnpj = $_GET['cnpj'];
                $link = "https://www.receitaws.com.br/v1/cnpj/$cnpj";
                $iniciar= curl_init($link);

                curl_setopt($iniciar,CURLOPT_RETURNTRANSFER,true);
                curl_setopt($iniciar, CURLOPT_SSL_VERIFYPEER, false);
                $resultados = json_decode(curl_exec($iniciar));
                foreach($resultados as $chave=>$texto){
                $$chave = $texto;
            }
            curl_close($iniciar);
            }elseif(isset($_POST['cadastrar'])){
                $nome = trim($_POST['empresa']);
                var_dump($nome);
            }




            ?>

        <form action="#" method ="get">

        <label for="">Insira o CNPJ</label>
        <input type="text" name="cnpj">



        <input type="submit" name= "enviar">


        </form>


            <form action="#" method="post">

                <div class="resultado">
                    <h3>Resultados</h3>
                    
                    <label for="">Nome</label>
                    <input type="text" name="empresa"   value ="<?= isset($nome)?$nome:''?>">
                    
                    
                    <label for="">Nome Fantasia</label>
                    <input type="text" name="fantasia"  value = '<?=isset($fantasia)?$fantasia:''?>'>
                    
                    
                    <label for="">Data de Abertura</label>
                    <input type="text" name="abertura_data" value = '<?=isset($abertura)?$abertura:''?>'>
                    
                    <label for="">Matriz ou Filial</label>
                    <input type="text" name="matriz" value = '<?=isset($tipo)?$tipo:''?>'>
                    
                    
                    
                    <label for="">Longradouro</label>
                    <input type="text" name="logradouro" value ='<?= isset($logradouro)?$logradouro:''?>'>
                    
                    
                    
                    <label for="">Numero</label>
                    <input type="text" name="numero" value = '<?=isset($numero)?$numero:''?>'>
                    
                    
                    
                    
                    <label for="">Complemento</label>
                    <input type="text" name="complemento" value = '<?=isset($complemento)?$complemento:''?>'>
                    
                    
                    <label for="">Situação Cadastral</label>
                    <input type="text" name="situacao" value = '<?=isset($status)?$status:''?>'>
                    
                    
                </div>
                <input type="submit" name="cadastrar" value="Cadastrar">
            </form>




        </body>
        </html>