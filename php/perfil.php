<?php
require 'autenticacao.php';
?>



<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <link rel="stylesheet" href="../css/perfil.css">
        <title>Perfil</title>
    </head>

    <body>
        <div id="login">
            <form class="card">
            <div class="conteudo">
                <div class="card-header">
                    <h2>Perfil</h2>
                    <?php if ($user_id == 1): ?>
                    <img src="../images/admin.jpg" width=380px id="anya">
                    <?php else: ?>
                    <img src="../images/baleia.png" width=380px id="baleia">
                    <?php endif; ?>
                    
                </div>
                <div class="card-content">
                    <div class="card-content-area" id=grid1>
                        <label for="usuario">Nome</label>
                        <a> <?php echo $user_name ?> </a>
                    </div>
                    <div class="card-content-area" id=grid2>
                        <label for="cpf">CPF</label>
                        <a> <?php echo $user_cpf ?> </a>
                    </div>
                    <div class="card-content-area" id=grid3>
                        <label for="email">Email</label>
                        <a> <?php echo $user_email ?> </a>
                    </div>
                    <div class="card-content-area" id=grid4>
                        <label for="endereço">Endereço</label>
                        <a> <?php echo $user_endereço ?> </a>
                    </div>
                    <div class="card-content-area" id=grid5>
                        <label for="complemento">Complemento de endereço</label>
                        <a> <?php echo $user_complemento ?> </a>
                    </div>
                    <div class="card-content-area" id=grid6>
                        <label for="cep">CEP</label>
                        <a> <?php echo $user_cep ?> </a>
                    </div>
                
                </form>
                <div class="card-footer">
                    <form action="edita.php">
                    <button type="submit" class="submit" id=ep>Editar perfil</button>
                    </form>
                    <form action="../index.php">
                    <button type="submit" class="submit" id=pi>Página Inicial</button>
                    </form>
                    </div>
                 </div>
             </div>
      

        </div>

    </body>

</html>
