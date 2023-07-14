<?php 
  function verifica_campo($texto){
  $texto = trim($texto);
  $texto = stripslashes($texto);
  $texto = htmlspecialchars($texto);
  return $texto;
}
$nome = $preço = $imagem = $descrição = "";
$erro = false;



//Validação NOME
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty($_POST["nome"])){
        $erro_nome = "Nome é obrigatório.";
        $erro = true;
      }
      else{
        $nome = verifica_campo($_POST["nome"]);
      }
//Validação PREÇO
if(empty($_POST["preço"])){
        $erro_preço = "Preço é obrigatório.";
        $erro = true;
      }
      else{
        $preço = verifica_campo($_POST["preço"]);
      }
//Validação Descrição
if(empty($_POST["descrição"])){
        $erro_descrição = "A descrição é obrigatória.";
        $erro = true;
      }
      else{
        $descrição = verifica_campo($_POST["descrição"]);
      }

//UPLOAD DE IMAGEM E VALIDAÇÃO
$target_dir = "../images/Produtos/";
$target_file = $target_dir . basename($_FILES["imagem"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["imagem"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $erro_imagem = "O arquivo não é uma imagem.";
    $erro = true;
    $uploadOk = 0;
  }
}
if ($_FILES["imagem"]["size"] > 1000000) {
  $erro_imagem = "A imagem é muito grande.";
  $erro = true;
  $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png") {
  $erro_imagem = "A extensão usada não é suportada.";
  $erro = true;
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  $erro_imagem .= " o upload falhou.";
  $erro = true;
} else {
  if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
  $imagem = "images/Produtos/" . $_FILES["imagem"]["name"]; 

  // atribuição do path da imagem pra variavel $imagem
  } 
}
}
?>