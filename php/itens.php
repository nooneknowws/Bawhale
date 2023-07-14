<?php
include '../config.php';
include 'autenticacao.php';

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

$sql = "select * from Products";
$query_products= mysqli_query($conn, $sql);

if(!$query_products){
  die('Error:' . mysqli_connect_error());
}

if (isset($_POST['delete'])) {
  $delete = $_POST['delete'];
  
  $sql = "select * from Products where Id = $delete";
  $query_delete = mysqli_query($conn, $sql);

  if(mysqli_num_rows($query_delete) == 1){
    $sql = "delete from Products where Id = $delete;";
    $query_delete = mysqli_query($conn, $sql);
  }

  header("Refresh:0");
}
if(!$login){
  $user_id = "";
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Lista de itens bawhale</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/itens.css">
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
    <div class="main">
      <div class="content"><div class="cart rounded rounded-5">
      <div class="card">    
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
          <h1 class="text-center">Lista de itens bawhale</h1>  
          <table class="table table-striped table-dark">
              <thead>
                <tr>
                  <th>Produto</th>
                  <th style="width: 10%;">Valor</th>
                  <th style="width: 10%;">Remover</th>
                </tr>
              </thead>
              <tbody>
		<?php $total = 0; ?>
		<?php while($products_item = mysqli_fetch_array($query_products)): ?>
		    <tr><form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
		      <td><?= $products_item['Name']; ?></td>
		      <td>$<?= $products_item['Price']/100; ?></td>
		      <td><button value="<?= $products_item['Id']; ?>" class="btn btn-danger btn-sm" id=dele name="delete">x</button></td>
                    </tr></form>
		<?php endWhile; ?>
		
                </tbody>
              </table>
            </form>
            <div class="card-footer">
                    <form action="produtos.php">
                    <button type="submit" class="submit" id=ep>Cadastrar novo produto</button>
                    </form>
                    <form action="../index.php">
                    <button type="submit" class="submit" id=pi>Voltar</button>
                    </form>
                    </div>
                 </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
