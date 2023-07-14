<?php

include 'config.php';

$admin_pass = "";
//conexão
$conn = mysqli_connect($host, $user, $pass);

//validação da conexão
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//criação da database
$sql = "CREATE DATABASE $db";
if (mysqli_query($conn, $sql)) {
    echo "<br>Database created successfully<br>";
} else {
    echo "<br>Error creating database: " . mysqli_error($conn);
}

//escolha da database
$sql = "USE $db";
if (mysqli_query($conn, $sql)) {
    echo "<br>Database changed successfully<br>";
} else {
    echo "<br>Error changing database: " . mysqli_error($conn);
}

//criação de tabelas

//produto:
$sql = "CREATE TABLE Products (
    Id int NOT NULL AUTO_INCREMENT,
    Name varchar(255) NOT NULL,
    Price int,
    Descri varchar(4096) NOT NULL,
    ImageURL varchar(4096) NOT NULL,
    PRIMARY KEY (Id)
)";

if (mysqli_query($conn, $sql)) {
    echo "<br>Table created successfully<br>";
} else {
    echo "<br>Error creating database: " . mysqli_error($conn);
}
//carrinho
$sql = "CREATE TABLE Cart (
    Id int NOT NULL AUTO_INCREMENT,
    ProductId int NOT NULL,
    Quantity int NOT NULL,
    descri varchar(4096),
    PRIMARY KEY (Id),
    FOREIGN KEY (ProductId) REFERENCES Products(Id)
)";

if (mysqli_query($conn, $sql)) {
    echo "<br>Table created successfully<br>";
} else {
    echo "<br>Error creating database: " . mysqli_error($conn);
}
//usuarios - login
$sql = "CREATE TABLE usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(128) NOT NULL,
    endereço varchar(255) NOT NULL,
    cpf varchar(11),
    picture varchar(4096),
    cep varchar(8),
    complemento varchar(255)
  )";
  
  if (mysqli_query($conn, $sql)) {
      echo "<br>Table created successfully<br>";
  } else {
      echo "<br>Error creating database: " . mysqli_error($conn);
  }

  $admin_pass = md5("admin");


//Adição de dados necessários para o funcionamento do site
$sql =  "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Estante', 24480, 'images/Produtos/p01.jpg','Estante branca de madeira, formato de baleia cachalote, fundo de rede');" . 
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Decoração metadinha', 16931, 'images/Produtos/p02.jpg','Duas peças de decoração que se encaixam, baleias azuis de madeira');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Mobile infantil', 14799, 'images/Produtos/p03.jpg','Mobile infantil para berço de baleias, nuvens e estrelas feitas de feltro, suporte de madeira');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Baleias de parede em relevo', 44480, 'images/Produtos/p04.jpg','Adorno de parede com três baleias jubarte, com relevo');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Porta velas - baleia e barco', 06931, 'images/Produtos/p05.jpg','Porta velas em forma de baleia cachalote com barco em sua cauda onde esta o espaço para a vela');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Porta velas - baleia cachalote', 01799, 'images/Produtos/p06.jpg','Porta velas em forma de baleia cachalote com três espaços para a velas');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Abajur - baleia de madeira', 21480, 'images/Produtos/p07.jpg','Abajur com base baleia feita de madeira');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Abajur - baleia cachalote', 26931, 'images/Produtos/p08.jpg','Abajur com base baleia feita em formato de baleia cachalote');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Baleia de pelúcia - malha canelada', 7599, 'images/Produtos/p09.jpg','Pelúcia de baleia revestida de malha canelada');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Luminária - baleia jubarte', 24480, 'images/Produtos/p10.jpg','Luminária vazada com forma de baleia Jubarte');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Luminária - baleia cidade', 24480, 'images/Produtos/p11.jpg','Luminária com forma de baleia Jubarte e decoração de cidade em sua barriga');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Mobile - Nébula', 36931, 'images/Produtos/p12.jpg','Mobile Nébula de metal altamente detalhado de baleias, astros e nuvens');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Quadro 3 partes - baleia jubarte', 37919, 'images/Produtos/p13.jpg','Três partes de um quadro, juntos formam uma bela pintura de baleia jubarte');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Quadro 3 partes - duas baleias', 34480, 'images/Produtos/p14.jpg','Três partes de um quadro, juntos formam uma bela pintura de duas baleias jubarte');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Cesto branco', 16931, 'images/Produtos/p15.jpg','Cesto de decoração branco feito de palha, multiuso');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Cesto castanho', 17969, 'images/Produtos/p16.jpg','Cesto de decoração castanho feito de palha, multiuso');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Baleia de pelúcia - baleia azul', 4480, 'images/Produtos/p17.jpg','Pelúcia de baleia azul celeste, bem fofinha e macia');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Baleias de pelúcia - baleia jubarte', 6931, 'images/Produtos/p18.jpg','Duas pelúcias azul marinho de baleia jubarte, baleia e filhote');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Baleia de pelúcia - baleia  estampa espiral', 1799, 'images/Produtos/p19.jpg','Pelúcia de baleia jubarte estampa espiral padrão irregular');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Baleia de pelúcia - baleia cinza', 4480, 'images/Produtos/p20.jpg','Pelúcia de baleia cachalote cinza, revestimento de tecido');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Cesto com tampa castanho', 16931, 'images/Produtos/p21.jpg','Cesto castanho feito de palha em formato de baleia, multiuso');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Almofada baleia franca', 5799, 'images/Produtos/p22.jpg','Almofada com fundo azul marinho e estampa de baleia franca');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Almofadas baleia em corte', 4480, 'images/Produtos/p23.jpg','Duas almofadas em corte de baleia, uma  estampa de baleia jubarte e a outra estampa floral padrão aleatório');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Almofada tubarão baleia', 6931, 'images/Produtos/p24.jpg','Almofadas estampa tubarão baleia padrão aletório');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Cadeira peluciada azul', 61199, 'images/Produtos/p25.jpg','Cadeira mega confortável peluciada em azul celeste, formato de baleia');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Vaso suculenta branco', 4480, 'images/Produtos/p26.jpg','Vaso para suculentas branco de cerâmica em formato de baleia');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Vaso suculenta perolado', 6931, 'images/Produtos/p27.jpg','Vaso para suculentas perolado de cerâmica em formato de baleia');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Suporte aparador livros - azul', 13799, 'images/Produtos/p28.jpg','Suporte aparador de livros azul em formato de baleia cachalote');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Suporte aparador livros - preto', 14480, 'images/Produtos/p29.jpg','Suporte aparador de livros preto em formato de baleia cachalote');" .
        "INSERT INTO Products (Name, Price, ImageURL,Descri) VALUES ('Armário azul madeira estampado', 58831, 'images/Produtos/p30.jpg','Armário de madeira na cor azul com estampa de baleia jubarte');" .
        "INSERT INTO usuarios (nome, email, senha, endereço, cpf, picture, cep, complemento  ) VALUES ('Administrador', 'admin@root.com', '$admin_pass', 'root', '00000000000', 'images/admin.jpg', '00000000', 'casa');";

if (mysqli_multi_query($conn, $sql)) {
    echo "<br>inserted successfully<br>";
} else {
    echo "<br>Error creating database: " . mysqli_error($conn);
    die("<br>Por favor digite uma senha de administrador.");
}

mysqli_close($conn);

?>
<html>
    <body>
    <a href="php/login.php"> Login! </a>
    </body>
</html>

