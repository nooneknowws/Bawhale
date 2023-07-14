<?php
include 'config.php';
require 'php/autenticacao.php';

$buy = "";
$delete = "";
$add = "";
$conn = mysqli_connect($host, $user, $pass, $db);
if(!$conn){
  die('Problemas ao conectar ao BD: ' . mysqli_connect_error());
}

$sql = "use $db";
$query = mysqli_query($conn, $sql);

if(!$query){
  die('Error:' . mysqli_connect_error());
}

$sql = "select Id, Name, ImageURL, Price from Products";
$query_products = mysqli_query($conn, $sql);

if(!$query_products){
  die('Error:' . mysqli_connect_error());
}

$sql = "select * from Cart inner join Products on (Cart.ProductId = Products.Id)";
$query_cart = mysqli_query($conn, $sql);

if(!$query_cart){
  die('Error:' . mysqli_connect_error());
}

if (isset($_POST['delete'])) {
  $delete = $_POST['delete'];
  
  $sql = "delete from Cart where ProductId = $delete and Quantity >= 1;";
  $query_delete = mysqli_query($conn, $sql);
  header("Refresh:0");
}

if (isset($_POST['add'])) {
  $add = $_POST['add'];
  
  $sql = "select * from Cart where ProductId = $add";
  $query_add = mysqli_query($conn, $sql);

  if(mysqli_num_rows($query_add) == 1){
    $sql = "update Cart set Quantity = Quantity + 1 where ProductId = $add";
    $query_add = mysqli_query($conn, $sql);
  }
  header("Refresh:0");
}

if (isset($_POST['buy'])) {
  $buy = $_POST['buy'];
  
  $sql = "select * from Cart where ProductId = $buy";
  $query_increment = mysqli_query($conn, $sql);

  if(mysqli_num_rows($query_increment) == 0){
    $sql = "insert into Cart (ProductId, Quantity) values ($buy, 1)";
    $query_buy = mysqli_query($conn, $sql);
  }
  else {
    $sql = "update Cart set Quantity = Quantity + 1 where ProductId = $buy;";
    $query_buy = mysqli_query($conn, $sql);
  }
  header("Refresh:0");
}

if (isset($_POST['checkout'])) {
  $buy = $_POST['checkout'];
  
  $sql = "select * from Cart where ProductId = $buy";
  $query_increment = mysqli_query($conn, $sql);

  if(mysqli_num_rows($query_increment) == 0){
    $sql = "insert into Cart (ProductId, Quantity) values ($buy, 1)";
    $query_buy = mysqli_query($conn, $sql);
  }
  else {
    $sql = "update Cart set Quantity = Quantity + 1 where ProductId = $buy;";
    $query_buy = mysqli_query($conn, $sql);
  }

  header("Location: php/checkout.php");
}

if (isset($_POST['view'])) {
  $view = $_POST['view'];
  header("Location: php/view.php" . "?view=" . $view);
}

if(!$login){
  $user_id = 0;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Bawhale</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body id="corpo">
    <main>
         <nav class="navbar navbar-light">
          <a class="navbar-brand" href="#">
         <img class="w-100" src="images/site-header.png">
        </a>
      </nav>
      <div class="d-flex flex-column flex-shrink-0 p-3 text-white cart">
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($user_id == 1): ?>
            <img src="images/admin.jpg" alt="" class="rounded-circle me-2" width="64" height="32">
            <?php else: ?>
            <img src="images/baleia.png" alt="" class="rounded-circle me-2" width="64" height="32">
            <?php endif; ?>
            <?php if ($login): ?>
            <strong><?= $user_name?></strong>
            <?php else: ?>
            <strong>Visitante</strong>
            <?php endif; ?>
          </a>
          <ul class="dropdown-menu-dropdown-menu-dark-text-small-shadow" aria-labelledby="dropdownUser1">
          <?php if (!$login): ?>
            <li>
              <a class="text-white dropdown-item" href="php/login.php">Login</a>
            </li>
            <li>
              <a class="text-white dropdown-item" href="php/cadastro.php">Cadastre-se</a>
            </li>
            <?php else: ?>
            <li>
              <a class="text-white dropdown-item" href="php/logout.php">Logout</a>
            </li>
            <li>
              <a class="text-white dropdown-item" href="php/perfil.php">Perfil</a>
            </li>
            <li>
              <a class="text-white dropdown-item" href="php/edita.php">Editar perfil</a>
            </li>
            <?php endif; ?>
            <?php if ($user_id == 1): ?>
              <li>
              <a class="text-white dropdown-item" href="php/itens.php">Visualizar produtos</a>
            </li>
            <?php endif; ?>
          </ul>
        </div>
        <hr>
        <div class="tabela">
          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <table class="table text-white">
              <thead>
                <tr>
                  <th>Qtde.</th>
                  <th>Produto</th>
                  <th>Valor</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
		<?php $total = 0; ?>
    <?php while($cart_item = mysqli_fetch_array($query_cart)): ?>
		  <?php $total += ($cart_item['Price'] * $cart_item['Quantity']) ?>
		    <tr><form action="<?= $_SERVER['PHP_SELF'] ?>" method="post"></tr>
	              <td>
			<button value="<?= $cart_item['ProductId']; ?>" class="btn btn-sm btn-fake" name="delete">-</button>
			<?= $cart_item['Quantity']; ?>
			<button value="<?= $cart_item['ProductId']; ?>" class="btn btn-sm btn-fake" name="add">+</button>
		      </td>
		      <td><?= $cart_item['Name']; ?></td>
		      <td>$<?= $cart_item['Price']/100; ?></td>
		      <td><button value="<?= $cart_item['ProductId']; ?>" class="btn btn-sm dele" name="delete">x</button></td>
          
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
		  <td colspan="2"><h5><b>Total à vista:</b></h5></td>
		  <td colspan="2"><h5><b>$<?= round(($total/100)*0.95, 2) ?></b></h5></td>
		</tr>
		<?php endif; ?>
              </tbody>
            </table>
    </form>
            <form method="POST" action="php/checkout.php">
            <?php if ($total <= 0): ?>
            <button name="checkout" class="btn paga col-12" value="" disabled>Ir para o pagamento</button>
            <?php else: ?>
            <button name="checkout" class="btn paga col-12" value="">Ir para o pagamento</button>
            <?php endif; ?>
          </form>
        </div>
      </div>
      <div class="content p-4">
        <div class="card-columns">
	    <?php while($produto = mysqli_fetch_array($query_products)): ?>    
              <div class="card text-center w-100">
                <img class="card-img-top rounded rounded-2" id=image src="./<?= $produto['ImageURL'] ?>">
                <div class="card-body">
                  <h4 class="card-title"><?= $produto['Name'] ?></h4>
                  <div class="card-text">
                    <h5 class="fs-2">
                      <b>$<?= $produto['Price'] / 100?></b>
                    </h5>
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                      <div class="btn-group-vertical col-8" id=nho>
                        <button name="buy" class="btn add_btn" value="<?= $produto['Id'] ?>">Adicionar ao carrinho </button>
                        <button name="view" class="btn view_btn" value="<?= $produto['Id'] ?>">Ver produto </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
	          <?php endWhile; ?>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

