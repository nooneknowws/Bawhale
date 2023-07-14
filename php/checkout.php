<?php
include '../config.php';
include "autenticacao.php";

$result = "";
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

$sql = "select * from Cart inner join Products on (Cart.ProductId = Products.Id)";
$query_cart = mysqli_query($conn, $sql);

if(!$query_cart){
  die('Error:' . mysqli_connect_error());
}
if (isset($_POST["compra"])){
  $sql = "DELETE FROM Cart;";
  $result = mysqli_query($conn, $sql);
  header("Refresh:0");
} 


if (isset($_POST['delete'])) {
  $delete = $_POST['delete'];
  
  $sql = "select * from Cart where ProductId = $delete";
  $query_delete = mysqli_query($conn, $sql);

  if(mysqli_num_rows($query_delete) == 1){
    $sql = "delete from Cart where ProductId = $delete and Quantity = 1;";
    $query_delete = mysqli_query($conn, $sql);
    
    $sql = "update Cart set Quantity = Quantity - 1 where ProductId = $delete";
    $query_delete = mysqli_query($conn, $sql);
    
  }
  header("Refresh:0");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Carrinho de compras</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/checkout.css">
  </head>
  <body>
        <?php if(!$login): ?>
          <script> alert('Por favor complete seu cadastro antes de realizar uma compra.');</script>";
          <a href="cadastro.php"> Cadastro <a>
          </body>
          </html>
        <?php exit(); ?>
        <?php endif; ?>
    
  
    <div class="main">
      <div class="content"><div class="cart rounded rounded-5">
      <div class="card">    
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
          <h1 class="text-center">Carrinho</h1>  
          <table class="table table-striped table-dark">
              <thead>
                <tr>
                  <th style="width: 10%;">Qtde.</th>
                  <th>Produto</th>
                  <th style="width: 10%;">Valor</th>
                  <th style="width: 10%;"></th>
                </tr>
              </thead>
              <tbody>
		<?php $total = 0; ?>
		<?php while($cart_item = mysqli_fetch_array($query_cart)): ?>
		  <?php $total += ($cart_item['Price'] * $cart_item['Quantity']) ?>
		    <tr><form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
          <td><?= $cart_item['Quantity']; ?></td>
		      <td><?= $cart_item['Name']; ?></td>
		      <td>$<?= $cart_item['Price']/100; ?></td>
		      <td><button value="<?= $cart_item['ProductId']; ?>" class="btn btn-danger btn-sm" id=dele name="delete">x</button></td>
                    </tr></form>
		<?php endWhile; ?>
		<?php if ($total <= 0): ?>
		<tr>
                  <td colspan="4">
                    <h5>Seu carrinho está vazio.</h5>
                  </td>
                </tr>
		<?php else: ?>
		<tr>
		  <td colspan="2"><h5><b>Total:</b></h5></td>
		  <td colspan="2"><h5><b>$<?= $total/100 ?></b></h5></td>
		</tr>
		<tr>
		  <td class="text-primary" colspan="2"><h5><b>Total à vista:</b></h5></td>
		  <td class="text-primary" colspan="2"><h5><b>$<?= round(($total/100)*0.95, 2) ?></b></h5></td>
		</tr>
		<?php endif; ?>
                </tbody>
              </table>
            </form>
            <div class="card-footer">
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <button type="submit" class="submit" name="compra" value="1" id=ep>Finalizar compra</button>
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
    <?php
      if($result == true){
        echo "<script> alert('Compra finalizada com Sucesso!');</script>";
      }
      if(!$login){
        echo "<script> alert('Por favor complete seu cadastro antes de realizar uma compra.');</script>";
      }
    ?>
  </body>
</html>
