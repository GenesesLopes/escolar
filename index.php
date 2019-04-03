<?php
session_start();
include 'php/headIndex.php';
include 'php/conexao.php';
?>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        <?php if(!isset($_SESSION["tipo"])){?>
          <form class="navbar-form navbar-right" method="post" action="php/ações/login.php">
            <div class="form-group">
              <input type="text" placeholder="Login" name="login" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Senha" name="senha" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Autenticar</button>
          </form>
        <?php }else{?>
        <div class="container">
          <nav>
                <ul>
                    <li><a href="#">Motorista</a>
                        <ul>
                            <li><a href="php/formCadastroMotorista.php">Cadastrar</a></li>
                            <li><a href="#">Editar</a>
                              <ul>
                                <li><a href="#">Informações</a></li>
                                <li><a href="#">Condução</a></li>
                                <li><a href="#">Turno</a></li>
                                <li><a href="#">Situação</a></li>
                              </ul>
                            </li>
                            <li><a href="#">Listar</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Veículo</a>
                        <ul>
                            <li><a href="#">Cadastrar</a>
                              <ul>
                                <li><a href="php/formCadastroVeiculo.php">Informações</a></li>
                                <li><a href="php/formCadastroIntinerario.php">Intinerário</a></li>
                                <li><a href="php/formCadastroKm.php">Km no mês</a></li>
                              </ul>
                            </li>
                            <li><a href="#">Editar</a>
                              <ul>
                                <li><a href="#">Informações</a></li>
                                <li><a href="#">Turno</a></li>
                                <li><a href="#">Intinerário</a></li>
                                <li><a href="#">Situação</a></li>                              
                              </ul>
                            </li>
                            <li><a href="#">Listar</a></li>
                        </ul>
                    </li>
                    <li><a href="#" >Escolas</a>
                      <ul>
                        <li><a href="#">Cadastrar</a>
                          <ul>
                            <li><a href="php/formCadastroLocal.php">Escola</a></li>
                          </ul>
                        </li>  
                        <li><a href="#">Editar</a>
                          <ul>
                            <li><a href="#">Informações</a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                </ul>
                <ul>
                  <li><a href="#"><?php echo $_SESSION["login"];?></a>
                    <ul>
                      <?php if($_SESSION["tipo"]=="Administrador" || $_SESSION["tipo"]=="Secretario"){?>
                      <li><a href="#">Adicionar Usuário</a></li>
                      <?php }?>
                      <li><a href="#">Alterar</a>
                        <ul>
                          <li><a href="#">Informações</a></li>
                          <li><a href="#">Senha</a></li>
                        </ul>
                      </li>
                      <li><a href="php/sair.php">Sair</a></li>
                    </ul>
                   </li>
                </ul>
           </nav>
          </div>
        <?php }?>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
    <br>
    <!-- Main jumbotron for a primary marketing message or call to action -->
   

    <div class="container">
      <!-- Example row of columns -->
      <?php 
            $sql = "SELECT * FROM veiculo";
            $busca = $conexao->prepare($sql);
            $busca->execute();
            if(!$busca->rowCount()){
          ?>
          <h2>Não há registro de veículos na base de dados...</h2>
      <?php }else{?>
      <div>
        <div align="center" id="menuLocais">
        <h1>Locais</h1>
        <input type="radio" name="locais" id="locais" value="todos" checked>&nbsp;Todos
        <?php
          //Consulta os Locais Disponíveis
          $sql="SELECT nome FROM local";
          $local = $conexao->prepare($sql);
          $local->execute();
          $local->setFetchMode(PDO::FETCH_OBJ);
          while($result = $local->fetch()){
        ?>
        
        <input type="radio" name="locais" id="locais" value="<?php echo $result->nome;?>">&nbsp;<?php echo $result->nome;?>
        <?php }?>
        </div>
        <?php
          //Consulta todos os veículos
        $sql="SELECT * FROM veiculo";
        $veiculo = $conexao->prepare($sql);
        $veiculo->execute();
        $veiculo->setFetchMode(PDO::FETCH_OBJ);
        while($result = $veiculo->fetch()){
        ?>
        <div class="col-md-4 col-sm-6" id="locais">
            <div class="thumbnail">
                <!--Imagem do veículo-->
                <img src="img/<?php echo $result->foto;?>" class="img-rounded" alt="Foto do veículo">
                <div class="caption">
                  <h3><?php echo 'Marca ou Modelo: '.$result->marcaModelo;?></h3>
                  <p><?php echo 'Data de Cadastro: '.$result->dataCadastro;?></p>
                  <p><?php echo 'Km Inicial: '. $result->kmInicial;?></p>
                  <p><?php if($result->situacao) echo 'Situação: Ativo'; else echo 'Situação: Inativo';?></p>
                  <p><?php echo"Capacidade: ". $result->capacidade;?></p>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm">Detalhes &raquo</button>

                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                    <div class="modal-dialog modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" arial-label="Close"><span arial-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="gridSystemModalLabel">Titulo</h4>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                        </div>  
                        </div>
                        ...
                      </div>
                    </div>
                  </div>
                </div>
            <?php }
              }?>
            </div>
        </div>
      <hr>
    </div> <!-- /container -->
    <footer>
        <p align="center">&copy; 2016 Company, Inc.</p>
      </footer>
  </body>
</html>
