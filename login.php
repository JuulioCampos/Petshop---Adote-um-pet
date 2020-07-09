<?php

$pagina = "Login";
    require_once( 'layout/main.php');
    
    if(isset($_SESSION['usuario'])){
        header('location: inicio.php');
        exit;        
    }   
?>    
<link rel="stylesheet" href="css/registrar.css">
<div class="container">
    <div class="row borda-sombra">
        <div class="col-md-6 m-auto">
            <form action="App/controllers/LoginController.php" method="POST">
                <div class="form-group">
                    <input type="hidden" name="action" value="login">
                    <label for="email">Email</label>
                    <input type="email" class="borda-rosa radius-border form-control" id="email" placeholder="email@domain.com" name="email" required="required">
                </div>
                <div class="form-group">                        
                    <label for="senha">Senha</label>
                    <input type="password" class="borda-rosa radius-border form-control" id="senha" name="senha" required="required">
                </div>
                <button type="submit" class="borda btn btn-primary">Entrar</button>
                <a href="registrar.php" class="borda btn btn-primary">
                    Cadastrar-se
                </a>
            </form>
        </div>
        <div class="col-md-6 background-vector">
                <center><img class="background-image presente" src="images\vetores\bem vindo.png" alt=""></center>
    </div>
    </div>

</div>

<?php
    require_once('layout/footer.php'); 
?>    