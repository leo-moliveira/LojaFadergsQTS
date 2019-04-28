<?php
session_start();
ob_start();
include 'model/db_funcoes.php';
include_once 'model/usuario.class.php';
include 'control/lib.php';
include_once 'model/venda.class.php';
?>
<!DOCTYPE html>
<html><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/v4-shims.css">
  <link rel="stylesheet" href="index.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body class="container">
<!--Barra nav-->

  <nav class="navbar navbar-expand-md bg-primary navbar-dark fixed-top">
    <?php if(isset($_SESSION['privateUser'])){
      $u = unserialize($_SESSION['privateUser']);
      ?>
      <div class="container justify-content-end">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse text-center" id="navbar2SupportedContent">
          <a class="navbar-brand" href="index.php">Loja</a>
          <a class="navbar-brand" href="vendas.php">Vendas</a>
          <a class="navbar-brand" href="produtos.php">Produtos</a>
          <a class="navbar-brand" href="fornecedores.php">Fornecedores</a>
          <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
            <ul class="navbar-nav">
              <form id="deslogar" name="deslogar" action="" method="post">
                  <button type="submit" name="deslogar" class="btn navbar-btn btn-primary ml-2 text-white">
                    <i class="fas fa-sign-out-alt"> Sair</i>
                  </button>
              </form>
            </ul>
          </div>
        </div>
      </div>
      <?php
    }?>
  </nav>

<!--Corpo-->
<div  class="py-4">
  <?php
  if(isset($_SESSION['privateUser'])){
          $u = unserialize($_SESSION['privateUser']);
          $vendasDB = new VendaDB;
          $array = $vendasDB->listaVendas();
          ?>
  <div class="container py-4">
    <div class="jumbotron text-center">
      <?php if(isset($_POST['retomaVenda'])){ ?>
        <p class="h3">Vendas</p>
        <div class="container py-4 mt-2 mb-2">
          <div class="table-responsive">
          </div>
        </di>
      <?php } else { ?>
      <p class="h3">Vendas - Pendentes</p>
      <div class="container py-4 mt-2 mb-2">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <th>#</th>
              <th>Protudos</th>
              <th class="text-center" colspan="3">Ação</th>
            </thead>
          <tbody>
          <?php foreach($array as $a){ ?>
            <tr>
              <?php if($a->status==0){?>
                <th scope="row"><?php printf("$a->id");?></th>
                <td><?php printf ("$a->produto");?></td>
                <td class="text-right">
                  <form id="retomaVenda" action="" method="post">
                    <input type="hidden" id="inputVendaID" name="inputVendaID" value="<?php ?>">
                    <button type="submit" name="retomaVenda" class="btn btn-primary text-white"><i class="fas fa-cart-arrow-down"> Remotar venda</i></button>
                  </form>
                </td>
                <td>
                    <?php
                    if(isset($_POST['loginModal'])){
                      if($u->Grupo=='Administrador'){
                        $u = new Usuario();
                        $u = unserialize($_SESSION['privateUser']);
                      }else{
                        $Login = $_POST['inputLoginModal'];
                        $Senha = Seguranca::criptografar($_POST['inputPasswordModal']);

                        $u = new Usuario();
                        $u->Login = $Login;
                        $u->Senha = $Senha;
                      }

                      $uDB = new UsuarioDB();
                      $usuario = $uDB->verificaUsuario($u);
                          if($usuario && !is_null($usuario) && $usuario->Grupo == "Administrador"){
                            ?>
                            <script>javascript:alert('Venda Cancelada!');</script>
                            <?php
                          }else { ?>
                            <script>javascript:alert('Houve um erro ao cancelar a veda!');</script>
                          <?php }
                            unset($_POST['loginModal']);
                    }
                    if($u->Grupo != "Administrador") {?>
                      <!-- Button trigger modal -->
                      <button type="button" name="cancelarVenda" data-toggle="modal" data-target="#cancelarVendaModal" class="btn btn-primary text-white"><i class="fas fa-ban"> Cancelar venda</i></button>
                      <!-- Modal -->
                      <div class="modal fade" id="cancelarVendaModal" tabindex="-1" role="dialog" aria-labelledby="cancelarVendaModal" aria-hidden="true">
                        <div class="modal-dialog" role="form">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title fas fa-times" id="cancelarVendaModal"> Acesso Negado!</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="alert alert-danger" role="alert"> Necessário ser administrador para cancelar a venda! </div>
                                  <form id="loginModal" action="" method="post">
                                      <div class="form-group ">
                                          <input type="hidden" id="inputModalID" name="inputModalID" value="<?php printf("$a->id"); ?>">
                                          <input type="int" class="form-control" id="inputLoginModal" name="inputLoginModal" placeholder="Login">
                                      </div>
                                      <div class="form-group">
                                          <input type="password" class="form-control" id="inputPasswordModal" name="inputPasswordModal" placeholder="Senha">
                                      </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" name="loginModal" id="btn-loginModal" value="Entrar" class="btn navbar-btn btn-primary ml-2 text-white"><i class="fas fa-ban"> Cancelar</i>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php }else{
                      ?>
                      <form id="loginModal" action="" method="post">
                          <input type="hidden" id="inputModalID" name="inputModalID" value="<?php printf("$a->id"); ?>">
                          <button type="submit" name="loginModal" id="btn-loginModal" value="Entrar" class="btn navbar-btn btn-primary ml-2 text-white"><i class="fas fa-ban"> Cancelar venda</i>
                        </form>
                    <?php } ?>
                </td>
                <?php }?>
            </tr>
        <?php } ?>
      </tbody>
          </table>
          </div>
        </div>
    </div>
    <div class="jumbotron text-center">
      <p class="h3">Vendas - Efetuadas</p>
      <div class="container py-4 mt-2 mb-2">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <th>#</th>
              <th>Protudos</th>
              <th>Ação</th>
            </thead>
          <tbody>
          <?php foreach($array as $a){ ?>
            <tr>
              <?php if($a->status==1){?>
                <th scope="row"><?php printf("$a->id")?></th>
                <td><?php printf ("$a->produto")?></td>
                <td>
                <?php
                if(isset($_POST['exluirVenda'])){
                  if($u->Grupo=='Administrador'){
                    $u = new Usuario();
                    $u = unserialize($_SESSION['privateUser']);
                  }else{
                    $Login = $_POST['inputLoginModal'];
                    $Senha = Seguranca::criptografar($_POST['inputPasswordModal']);

                    $u = new Usuario();
                    $u->Login = $Login;
                    $u->Senha = $Senha;
                  }

                  $uDB = new UsuarioDB();
                  $usuario = $uDB->verificaUsuario($u);
                      if($usuario && !is_null($usuario) && $usuario->Grupo == "Administrador"){
                        ?>
                        <script>javascript:alert('Venda Excluida!');</script>
                        <?php
                      }else { ?>
                        <script>javascript:alert('Houve um erro ao excluir a veda!');</script>
                      <?php }
                        unset($_POST['loginModal']);
                }
                if($u->Grupo != "Administrador") {?>
                  <!-- Button trigger modal -->
                  <td class"text-right"><button type="button" name="exluirVenda" data-toggle="modal" data-target="#exluirVendaModal" class="btn btn-primary text-white"><i class="far fa-trash-alt"> Excluir venda</i></button><td>
                  <!-- Modal -->
                  <div class="modal fade" id="exluirVendaModal" tabindex="-1" role="dialog" aria-labelledby="exluirVendaModal" aria-hidden="true">
                    <div class="modal-dialog" role="form">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title fas fa-times" id="exluirVendaModal"> Acesso Negado!</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="alert alert-danger" role="alert"> Necessário ser administrador para excluir venda! </div>
                              <form id="loginModal" action="" method="post">
                                  <div class="form-group ">
                                      <input type="hidden" id="inputModalID" name="inputModalID" value="<?php printf("$a->id"); ?>">
                                      <input type="int" class="form-control" id="inputLoginModal" name="inputLoginModal" placeholder="Login">
                                  </div>
                                  <div class="form-group">
                                      <input type="password" class="form-control" id="inputPasswordModal" name="inputPasswordModal" placeholder="Senha">
                                  </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" name="exluirVenda" id="btn-loginModal" value="Entrar" class="btn navbar-btn btn-primary ml-2 text-white"><i class="fas fa-ban"> Excluir</i>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php }else{
                  ?>
                  <form id="exluirVendaModal" action="" method="post">
                      <input type="hidden" id="inputModalID" name="inputModalID" value="<?php printf("$a->id"); ?>">
                      <button type="submit" name="exluirVenda" id="btn-loginModal" value="Entrar" class="btn navbar-btn btn-primary ml-2 text-white"><i class="fas fa-ban"> Excluir venda</i>
                    </form>

                <?php } ?>
              </td>
              <?php } ?>
            </tr>
        <?php } ?>
      </tbody>
          </table>
          </div>
        </div>
    </div>
  <?php } ?>
  </div>
  <?php
      if(isset($_POST['deslogar'])){
          unset($_SESSION['privateUser']);
          header("location:index.php");
        }
  }else{
  }?>
</div>

<!--Rodape-->
  <div class="py-3 footer">
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
