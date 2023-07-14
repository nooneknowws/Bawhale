<?php
include '../config.php';
require 'autenticacao.php';
include 'validacao.php';
$conn = mysqli_connect($host, $user, $pass, $db);
    if(!$conn){
    die('Problemas ao conectar ao BD: ' . mysqli_connect_error());
    }

    $sql = "use $db";
    $query = mysqli_query($conn, $sql);

    if(!$query){
    die('Error:' . mysqli_connect_error());
    }
    $sql = "SELECT id, nome, email, endereço, cpf, cep, complemento FROM usuarios
    WHERE id = '$user_id';";
    $result = mysqli_query($conn, $sql);
    if($result){
        if (mysqli_num_rows($result) > 0) {
          $user = mysqli_fetch_assoc($result);
        }
    }
    $close = false;
?>



<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="../css/edita.css">
        <title>Editar perfil</title>
    </head>

    <body>
        <?php
           if ($_SERVER["REQUEST_METHOD"] == "POST" && $erro == false){
            $sql = "UPDATE usuarios SET nome='$nome' WHERE id='$user_id';" .
                   "UPDATE usuarios SET email='$email' WHERE id='$user_id';" . 
                   "UPDATE usuarios SET cpf='$cpf' WHERE id='$user_id';" . 
                   "UPDATE usuarios SET endereço='$endereço' WHERE id='$user_id';" . 
                   "UPDATE usuarios SET cep='$cep' WHERE id='$user_id';" . 
                   "UPDATE usuarios SET complemento='$complemento' WHERE id='$user_id';";
                mysqli_multi_query($conn, $sql);
                echo "<script>alert('Cadastro alterado com sucesso, por favor realizar o login novamente');</script>";
            }  
        ?>
        <div id="login">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="card">
                <div class="card-header">
                    <h2>Editar perfil</h2>
                    <img src="../images/baleia.png" width=200px>
                </div>
                <div class="card-content">
                    <div class="card-content-area <?php if(!empty($erro_nome)){echo "has-error";}?>">
                        <label for="usuario">Nome</label>
                        <a> <?php echo $user_name ?> </a>
                        <input type="text" name="nome" value="<?php echo $nome; ?>" autocomplete="off">
                        <div>
                            <?php if (!empty($erro_nome)): ?>
                            <span class="help-block"><?php echo $erro_nome ?></span>
                            <?php endIf; ?>
                        </div>
                            </div>
                        
                    <div class="card-content-area <?php if(!empty($erro_cpf)){echo "has-error";}?>">
                        <label for="cpf">CPF</label>
                        <a> <?php echo $user_cpf ?> </a>
                        <input type="text" name="cpf" value="<?php echo $cpf; ?>" autocomplete="off">
                    </div>
                    <div>
                    <?php if (!empty($erro_cpf)): ?>
                    <span class="help-block"><?php echo $erro_cpf ?></span>
                    <?php endIf; ?>
                    </div>
                    <div class="card-content-area <?php if(!empty($erro_email)){echo "has-error";}?>">
                        <label for="email">Email</label>
                        <a> <?php echo $user_email ?> </a>
                        <input type="text" name="email" value="<?php echo $email; ?>" autocomplete="off">
                    </div>
                    <div>
                    <?php if (!empty($erro_email)): ?>
                    <span class="help-block"><?php echo $erro_email ?></span>
                    <?php endIf; ?>
                    </div>
                    <div class="card-content-area <?php if(!empty($erro_endereço)){echo "has-error";}?>"">
                        <label for="endereço">Endereço</label>
                        <a> <?php echo $user_endereço ?> </a>
                        <input type="text" name="endereço" value="<?php echo $endereço; ?>" autocomplete="off">
                    </div>
                    <div>
                    <?php if (!empty($erro_endereço)): ?>
                    <span class="help-block"><?php echo $erro_endereço ?></span>
                    <?php endIf; ?>
                    </div>
                    <div class="card-content-area">
                        <label for="complemento">Complemento</label>
                        <a> <?php echo $user_complemento ?> </a>
                        <input type="text" name="complemento"autocomplete="off">
                    </div>
                    <div class="card-content-area <?php if(!empty($erro_cep)){echo "has-error";}?>">
                        <label for="cep">CEP</label>
                        <a> <?php echo $user_cep ?> </a>
                        <input type="text" name="cep" value="<?php echo $cep; ?>" autocomplete="off">
                    </div>
                    <div>
                    <?php if (!empty($erro_cep)): ?>
                    <span class="help-block"><?php echo $erro_cep ?></span>
                    <?php endIf; ?>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="submit" id=tp1>Confirmar dados</button>
                    </form>
                    <form action="../index.php">
                    <button type="submit" class="submit" id=tp2>Página Inicial</button>
                    </form>
                    <form action="logout.php">
                    <button type="submit" class="submit" id=tp3>Logout</button>
                    </form>
                </div>


        </div>

    </body>

</html>
