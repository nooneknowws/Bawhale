<?php
  session_start();

  if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"]) && isset($_SESSION["user_email"])&& isset($_SESSION["user_endereço"])&& isset($_SESSION["user_cpf"])) {
    $login = true;
    $user_id = $_SESSION["user_id"];
    $user_name = $_SESSION["user_name"];
    $user_email = $_SESSION["user_email"];
    $user_endereço = $_SESSION["user_endereço"];
    $user_cpf = $_SESSION["user_cpf"];
    $user_complemento = $_SESSION["user_complemento"];
    $user_cep = $_SESSION["user_cep"];
  }
  else{
    $login = false;
  }

?>