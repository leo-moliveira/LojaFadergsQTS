<?php
include '../model/db_funcoes.php';
include '../model/venda.class.php';

/*
include 'usuario.class.php';
include 'db_funcoes.php';

$usuario = new Usuario();
$usuario->Email = "b@estqcontrole.com.br";
$usuario->Senha = "123";
var_dump($usuario);
echo("<br><br><br>");

$usuarioDB = new UsuarioDB();
$usuario2 = $usuarioDB->verificaUsuario($usuario);
var_dump($usuario2);

*/
/*
include '../model/db_funcoes.php';
include '../model/produto.class.php';

$produtoDB = new ProdutoDB;
$array = $produtoDB->listaProdutos();

$produto = new Produto;
//var_dump($produto);
echo "<br>";
echo "<br>";
echo "<br>";
$produto->id=14;
$produto->Nome="Fanta";
$produto->Tipo='Refrigerante';
$produto->Valor=3.99;
$produto->Vendas=0;
$produto->EstqLoja=40;
$produto->EstqMin=0;
$produto->EstqEntrada=40;
$produto->Fornecedor='Refris S.A';

echo "<br>";
echo "<br>";
echo "<br>";
$produtoDB->exluirProduto($produto);


//$array=NULL;
//$array = $produtoDB->listaProdutos();
//8	Pepsi	3		0	100	10	100	1222
foreach($array as $a){
  echo "<table>";
              echo "<tr>";
                echo "<td>$a->id</td>";
                echo "<td>$a->Nome</td>";
                echo "<td>$a->Tipo</td>";
                echo "<td>$a->Valor</td>";
                echo "<td>$a->Vendas</td>";
                echo "<td>$a->EstqLoja</td>";
                echo "<td>$a->EstqMin</td>";
                echo "<td>$a->EstqEntrada</td>";
                echo "<td>$a->Fornecedor</td>";

              echo "</tr>";
              echo "</table>";
            }


/*

            private $id;
            private $Nome;
            private $CNPJ;
            private $Endereco;
            private $Email;
            private $Estado;

include '../model/db_funcoes.php';
include '../model/fornecedor.class.php';

$fornecedorDB = new FornecedorDB;
$array = $fornecedorDB->busca(1,'Pepsi');
foreach($array as $a){


  echo "<table>";
              echo "<tr>";
                echo "<td>$a->id</td>";
                echo "<td>$a->Nome</td>";
                echo "<td>$a->CNPJ</td>";
                echo "<td>$a->Endereco</td>";
                echo "<td>$a->Email</td>";
                echo "<td>$a->Estado</td>";


              echo "</tr>";
              echo "</table>";
            }
*/

/*
include '../model/db_funcoes.php';
include '../model/produto.class.php';


$produto = new Produto;
$produto->id=13;
$produto->Nome="Fanta";
$produto->Tipo='Suco';
$produto->Valor=6.0;
$produto->Vendas=0;
$produto->EstqLoja=40;
$produto->EstqMin=0;
$produto->EstqEntrada=40;
$produto->Fornecedor='Refris S.A';

$produtoDB = new ProdutoDB;
$array = $produtoDB->modificaProduto($produto);
//$array = $produtoDB->listaProdutos();

$produto = "BIS";
$produtoDB = new ProdutoDB;
$array = $produtoDB->buscaProduto($produto);

foreach($array as $a){
  echo "<table>";
              echo "<tr>";
                echo "<td>$a->id</td>";
                echo "<td>$a->Nome</td>";
                echo "<td>$a->Tipo</td>";
                echo "<td>$a->Valor</td>";
                echo "<td>$a->Vendas</td>";
                echo "<td>$a->EstqLoja</td>";
                echo "<td>$a->EstqMin</td>";
                echo "<td>$a->EstqEntrada</td>";
                echo "<td>$a->Fornecedor</td>";

              echo "</tr>";
              echo "</table>";
            }



            $venda = new Venda;
            $venda->id = 3;
            $vendasDB = new VendaDB;
                $venda->produto = "Pepsi Cola 2L";
                $venda->status = 0;
                $venda->quantidade = 2;

                $vendasDB->removeProduto($venda);
INSERT INTO `vendas`(`id`, `status`) VALUES (3,0);
                INSERT INTO `vendaprodutos`(`idVendas`, `idProduto`, `quantidade`) VALUES (3,4,3);
                INSERT INTO `vendaprodutos`(`idVendas`, `idProduto`, `quantidade`) VALUES (3,5,1);
                INSERT INTO `vendaprodutos`(`idVendas`, `idProduto`, `quantidade`) VALUES (3,2,2);
                INSERT INTO `vendaprodutos`(`idVendas`, `idProduto`, `quantidade`) VALUES (3,4,1);
                INSERT INTO `vendaprodutos`(`idVendas`, `idProduto`, `quantidade`) VALUES (3,5,6);
                INSERT INTO `vendaprodutos`(`idVendas`, `idProduto`, `quantidade`) VALUES (3,6,2);
                INSERT INTO `vendaprodutos`(`idVendas`, `idProduto`, `quantidade`) VALUES (3,6,1);
                INSERT INTO `vendaprodutos`(`idVendas`, `idProduto`, `quantidade`) VALUES (3,5,11);
                INSERT INTO `vendaprodutos`(`idVendas`, `idProduto`, `quantidade`) VALUES (3,2,23);
                INSERT INTO `vendaprodutos`(`idVendas`, `idProduto`, `quantidade`) VALUES (3,6,1111);
                  */
                  $vendasDB = new VendaDB;
                  $array = $vendasDB->listaVendas();
                  foreach($array as $a){
                    printf("$a->id\n");
                    printf("$a->Produto\n");
                    printf("$a->Status\n");
                  }


?>
