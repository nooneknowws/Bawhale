<?php
include '../config.php';

$conn = mysqli_connect($host, $user, $pass, $db);
if(!$conn){
die('Problemas ao conectar ao BD: ' . mysqli_connect_error());
}

$sql = "use $db";
$query = mysqli_query($conn, $sql);

if(!$query){
die('Error:' . mysqli_connect_error());
}

function verifica_campo($texto){
  $texto = trim($texto);
  $texto = stripslashes($texto);
  $texto = htmlspecialchars($texto);
  return $texto;
}

$nome = $email = $senha = $verificasenha = $endereço = $cpf = $imagem = $complemento = $cep = "";
$erro = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if(empty($_POST["nome"])){
    $erro_nome = "O nome é obrigatório.";
    $erro = true;
  }
  else{
    $nome = verifica_campo($_POST["nome"]);
  }


if (empty($_POST["senha"])){
    $erro_senha = "A Senha é obrigatória";
    $erro = true;
  }
  if (empty($_POST["cpassword"])){
    $erro_verificasenha = "A verificação é obrigatória";
    $erro = true;
  }
  else{
      $senha = verifica_campo($_POST["senha"]);
      $verificasenha = verifica_campo($_POST["cpassword"]);
      if($senha == $verificasenha){
        $senha = md5($senha);
    }
      else{
        $erro_verificasenha = "As senhas não são iguais";
        $erro = true;
      }
  }
  if(empty($_POST["cpf"])){
    $erro_cpf = "O CPF é obrigatório.";
    $erro = true;
  }
  if((@strlen($_POST["cpf"]) != 11)){
    $erro_cpf = "O CPF digitado não tem 11 digitos.";
    $erro = true;
  }
  else{
    $cpf = verifica_campo($_POST["cpf"]);
    if(preg_match('/(\d)\1{10}/', $cpf)){
        $erro_cpf = "Os números não podem ser iguais.";
        $erro = true;
      }
      for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            $erro_cpf = "O CPF digitado é inválido.";
            $erro = true;
        }
    }
  }

  if(empty($_POST["email"])){
    $erro_email = "O Email é obrigatório.";
    $erro = true;
  }
  else{
    $email = verifica_campo($_POST["email"]);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $erro = false;
    } 
    else {
      $erro_email = $email;
      $erro_email .= " é um e-mail inválido";
      $erro = true;
    }
  }

  if(empty($_POST["endereço"])){
    $erro_endereço = "O endereço é obrigatório.";
    $erro = true;
  }
  else{
    $endereço = verifica_campo($_POST["endereço"]);
  }
    $complemento = @verifica_campo($_POST["complemento"]);

  if(empty($_POST["cep"])){
    $erro_cep = "O CEP é obrigatório.";
    $erro = true;
  }
  else{
    $cep = verifica_campo($_POST["cep"]);
  }
}
