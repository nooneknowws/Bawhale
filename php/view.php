<?php
include '../config.php';

$buy = "";
$delete = "";
$conn = mysqli_connect($host, $user, $pass, $db);
if(!$conn){
  die('Problemas ao conectar ao BD: ' . mysqli_connect_error());
}

$sql = "use $db;";
$query = mysqli_query($conn, $sql);

if(!$query){
  die('Error:' . mysqli_connect_error());
}

$view = $_GET['view'];
$sql = "select Id, Name, ImageURL, Price, Descri from Products where Id = $view";
$query_products = mysqli_query($conn, $sql);

if(!$query_products){
  die('Error:' . mysqli_connect_error());
}

if (isset($_POST['buy'])) {
  $buy = $_POST['buy'];
  $sql = "insert into Cart (ProductId, Quantity) values ($buy, 1)";
  $query_buy = mysqli_query($conn, $sql);
  header("Refresh:0");

  if(!$query_buy){
    die('Error:' . mysqli_connect_error());
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Detalhes</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/view.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </head>
  <body>
  <div class="main">
      <div class="content"> <?php while($produto = mysqli_fetch_array($query_products)): ?> <div class="card mb-3" style="max-width: 100%;">
        <h1 class="text-center">Informações do produto</h1>  
        <div class="row g-0">
            <div class="col-md-4">
              <img src="../
											<?= $produto['ImageURL'] ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h2 class="card-title">
                  <b> <?= $produto['Name'] ?> </b>
                </h2>
                <p class="card-text"> <?= $produto['Descri'] ?> </p>
                <small class="text-muted">de <s>$<?= round(($produto['Price'] / 100) * 1.05, 2)?></s> por </small>
                <p class="text-success">
                  <b class="fs-1">$<?= $produto['Price'] / 100?> </b>
                  <span class="text-success"> á vista com 5% de desconto</span>
                </p>
                <form action="../index.php" method="post">
		              <div class="btn-group col-12">
		                <button class="btn btn-success col-12" id=botão1 value="<?= $produto['Id'] ?>" name="checkout">Comprar agora</button>
                    <button class="btn btn-outline-secondary col-12" id=botão2 value="<?= $produto['Id'] ?>" name="buy">Adicionar ao carrinho</button>
                    <button href="../index.php" type="submit" class="submit">Página Inicial</button>
                </form>
		            </div>
              </div>
            </div>
          </div>
        </div> <?php endWhile; ?> </div>
    </div>
  </body>
</html>
