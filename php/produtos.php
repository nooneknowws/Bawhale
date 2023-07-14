<?php
  include '../config.php';
  require "validacaoprodutos.php";
  include 'autenticacao.php';

    $conn = mysqli_connect($host, $user, $pass, $db);
    if(!$conn){
    die('Problemas ao conectar ao BD: ' . mysqli_connect_error());
    }

    $sql = "use $db";
    $query = mysqli_query($conn, $sql);

    if(!$query){
    die('Error:' . mysqli_connect_error());
    }
    //INSERÇÃO DE PRODUTOS NA TABELA
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $erro == false) {
     $sql = "INSERT INTO Products
    (Name, Price , Descri, ImageURL) VALUES
    ('$nome', '$preço', '$descrição', '$imagem');";
    }

if(mysqli_query($conn, $sql)){
$success = true;
}
else {
$error_msg = mysqli_error($conn);
$error = true;
}
if(!$login){
    $user_id = "";
}
?>
<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="../css/produtos.css">
        <title>Cadastrar item</title>
    </head>

    <body>
    <?php if ($user_id != 1): ?>
        <div class="loginfeito">
                <img src="../images/baleia.png" width="800" height="500">
                
                <h1><strong>OOPS!</strong></h1>
                <h3><strong>VOCÊ NÃO TEM PERMISSÃO PARA ACESSAR ESSA PÁGINA!</strong></h3>
                <form action="../index.php">
                <div class="card-footer">
                <button type="submit" class="submitxd">Ir para a pagina inicial</button>
                </form>
                </div>
                </div>
                </body>
                </html>
    <?php exit(); ?>
    <?php endif; ?>
        

        <div id="login">
            <form enctype="multipart/form-data" method="POST" id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="card">
                <div class="card-header ">
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$erro): ?>
                <div class="alert alert-success">
                    <script>alert("Cadastro realizado com sucesso!")</script>
                    <?php // limpa o formulário.
                     $nome = $preço = $imagem = $descrição = "";
                    ?>
                </div>
                <?php endif; ?>
                    <h2>Cadastrar Item</h2>
                    <img src="../images/baleia.png" width=380px>
                </div>
                <div class="card-content <?php if(!empty($erro_nome)){echo "has-error";}?>">
                    <div class="card-content-area">
                        <label for="Name">Nome</label>
                        <input type="text" name="nome" value="<?php echo $nome; ?>" autocomplete="off">
                    </div>
                   
                    <div>
                    <?php if (!empty($erro_nome)): ?>
                    <span class="help-block"><?php echo $erro_nome ?></span>
                    <?php endIf; ?>
                    </div>
                    <div class="card-content-area <?php if(!empty($erro_preço)){echo "has-error";}?>">
                        <label for="preço">Preço</label>
                        <input type="number" name="preço" value ="<?php echo $preço; ?>" autocomplete="off">
                    </div>
                   
                    <div>
                    <?php if (!empty($erro_preço)): ?>
                    <span class="help-block"><?php echo $erro_preço ?></span>
                    <?php endIf; ?>
                    </div>
                    <div class="card-content-area <?php if(!empty($erro_imagem)){echo "has-error";}?>">
                        <label for="imageURL">Imagem</label>
                        <input type="file" name="imagem" value="<?php echo $imagem; ?>" autocomplete="off">
                    </div>
                   
                    <div>
                    <?php if (!empty($erro_imagem)): ?>
                    <span class="help-block"><?php echo $erro_imagem ?></span>
                    <?php endIf; ?>
                    </div>
                    <div class="card-content-area <?php if(!empty($erro_descrição)){echo "has-error";}?>">
                        <label for="descri">Descrição</label>
                        <input type="text" name="descrição" value="<?php echo $descrição; ?>" autocomplete="off">
                    </div>
                   
                    <div>
                    <?php if (!empty($erro_descrição)): ?>
                    <span class="help-block"><?php echo $erro_descrição ?></span>
                    <?php endIf; ?>
                    </div>
                    </div>
                    
                    <div class="card-footer">
                    <form method="POST" action="">
                    <button type="submit" class="submit" id=ep>Cadastrar</button>
                    </form>
                    <form method="POST" action="itens.php">
                    <button type="submit" class="submit" id=pi>Voltar</button>
                    </form>
                    </div>
                 </div>

            </form>

        </div>

    </body>

</html>
