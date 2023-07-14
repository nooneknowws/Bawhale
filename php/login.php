<?php
require "../config.php";
require "autenticacao.php";

$conn = mysqli_connect($host, $user, $pass, $db);
    if(!$conn){
    die('Problemas ao conectar ao BD: ' . mysqli_connect_error());
    }

    $sql = "use $db";
    $query = mysqli_query($conn, $sql);

    if(!$query){
    die('Error:' . mysqli_connect_error());
    }

$error = false;
$senha = $email = "";

if (!$login && $_SERVER["REQUEST_METHOD"] == "POST"){

    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $senha = mysqli_real_escape_string($conn,$_POST["senha"]);
    $senha = md5($senha);

    $sql = "SELECT id,nome,email,senha, endereço,cpf,cep,complemento FROM usuarios
            WHERE email = '$email';";

    $result = mysqli_query($conn, $sql);
    if($result){
      if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($user["senha"] == $senha) {

          $_SESSION["user_id"] = $user["id"];
          $_SESSION["user_name"] = $user["nome"];
          $_SESSION["user_email"] = $user["email"];
          $_SESSION["user_endereço"] = $user["endereço"];
          $_SESSION["user_cpf"] = $user["cpf"];
          $_SESSION["user_complemento"] = $user["complemento"];
          $_SESSION["user_cep"] = $user["cep"];

          header("Location: ../index.php");
          exit();
        }
        else {
          $error_msg = "Senha incorreta!";
          $error = true;
        }
      }
      else{
        $error_msg = "Usuário não encontrado!";
        $error = true;
      }
    }
    else {
      $error_msg = mysqli_error($conn);
      $error = true;
    }
  
}
?>
<!DOCTYPE html>

<html lang="pt-br">

    <head>


        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <link rel="stylesheet" href="../css/login.css">
        <title>Login</title>
    </head>

    <body>
    <?php if ($login): ?>
      <div class="loginfeito">
                <img src="../images/baleia.png" width="800" height="500">
                
                <h1><strong>OOPS!</strong></h1>
                <h3><strong>Você já está logado!</strong></h3>
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
            <form method="POST" action="login.php" class="card">
                <div class="card-header">
                    <h2>Bem vindo(a) de volta!</h2>
                    <img src="../images/baleia.png" width=380px>
                </div>
                <div class="card-content">
                <?php if ($error): ?>
                <h3 class="erro"><?php echo $error_msg; ?></h3>
                <?php endif; ?>
                    <div class="card-content-area">
                        <label for="usuario">Email</label>
                        <input type="text" name="email" autocomplete="off">
                    </div>
                    <div class="card-content-area">
                        <label for="password">Senha</label>
                        <input type="password" name="senha" autocomplete="off">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="submit">Login</button>
                    <a href="cadastro.php" class="ir_cadastrar">Não possui uma conta? Cadastre-se</a>

                </div>

            </form>

        </div>

    </body>

</html>
