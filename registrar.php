<?php require_once 'layout\main.php';
$pagina = "Cadastrar"; ?> 
<link rel="stylesheet" href="css\registrar.css">
<div class="container">
    <div class="row borda-sombra">
        <div class="col-md-6 ">
            <form class="registrar-form" action="App/controllers/LoginController.php" method="POST">
                <div class="title-register">
                    <h1>Cadastre-se</h1>
                    <h2>Informe seus dados pessoais</h2>
                </div>
                <div class="row">
                   
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" name="action" value="registrar">
                            <label for="nome">Nome</label>
                            <input type="text" class="borda-rosa radius-border form-control" id="nome" placeholder="Nome" name="nome" required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sobrenome">Sobrenome</label>
                            <input type="text" class="borda-rosa radius-border form-control" id="sobrenome" placeholder="Sobrenome" name="sobrenome" required="required">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="borda-rosa radius-border form-control" id="email" placeholder="email@domain.com" name="email" required="required">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">                        
                            <label for="senha">Senha</label>
                            <input type="password" class="borda-rosa radius-border form-control" id="senha" name="senha" required="required">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-check">
                            <input type="checkbox" class="borda-rosa radius-border form-check-input" id="admin" name="admin">
                            <label class="form-check-label" for="admin">Administrador</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="borda btn btn-primary">Registrar</button>
                    </div>
                </div>
            </form> 
        </div>
        <div class="col-md-6 background-vector">
                <center><img class="background-image" src="images\vetores\receba.png" alt=""></center>
        </div>
    </div>
</div>
<?php require_once('layout/footer.php'); ?>    