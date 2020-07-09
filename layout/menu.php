
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"  integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<div class="navtitle">
    <div class="indent">
        <a class="navbar-brand" href="index.php"><img class="logo navbar-logo" src="images\icons\logo1.png" alt="logo" ></a>        
        <div class="indent-second justify-content-end">
            <div class="redes-sociais">
                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </div>
            <span class="bar">|</span>
            <?php
                session_start();    
                if(isset($_SESSION['usuario'])){
                    echo '
                    <ul class="navbar-nav ">
                        <li class="borda nav-item dropdown">    
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Olá, ' . $_SESSION["usuario"]["nome"] . '
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                        if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
                            echo '<form action="App\controllers\SolicitacaoController.php" method="POST">
                                    <input type="hidden" name="action" value="listar">
                                    <button type="submit" class="dropdown-item">Solicitações</button>
                                </form>';
                        }
                                
                            echo '<form action="App\controllers\AnimalController.php" method="POST">
                                    <input type="hidden" name="action" value="pets">
                                    <button type="submit" class="dropdown-item">Meus pets</button>
                                </form>
                                <form action="App\controllers\LoginController.php" method="POST">
                                    <input type="hidden" name="action" value="logout">
                                    <button type="submit" class="dropdown-item" id="logout">Sair</button>
                                </form>
                            </div>
                        </li>
                    </ul>';
                }else{
                    echo '
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link borda" href="login.php">Login</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link borda" href="registrar.php">Cadastro</a>
                        </li>
                    </ul>';
                }
            ?>
        </div>
    </div>
</div>

<nav data-spy="affix" data-offset-top="2"class=".affix-top navbar navbar-expand-lg ">
    <div class="indent">
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <img class="icon-toggle"src="images\icons\menu-toggle.ico" alt="">
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link borda fixado" href="animalCriar.php">Faça um doação</a>
                </li>                
                <li class="nav-item dropdown">    
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Encontre um pet
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="cachorros.php">Cachorros</a>
                        <a class="dropdown-item" href="gatos.php">Gatos</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contato.php">Contato</a>
                </li>
            </ul>
            
        </div>
    </div>
</nav>