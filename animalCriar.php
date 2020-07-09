<?php require_once 'App\auth.php';


$pagina = "Criar adoação";?>    
<link rel="stylesheet" href="css/registrar.css">

<div class="container">
    <div class="row borda-sombra">
        <div class="col-md-6 ">
            <form action="App/controllers/AnimalController.php" method="POST" enctype="multipart/form-data">
                <div class="title-register">
                    <h1>Doe seu Pet</h1>
                    <h2>Informe os dados do seu animalzinho</h2>
                </div>
                <fieldset>
                    <div class="row">
                        <div class="col-md-8">
                            <div class=" form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="borda-rosa radius-border form-control" id="nome" name="nome" placeholder="Nome" required="required">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class=" form-group">
                                <label for="idade">Idade:</label>
                                <input type="text" class="borda-rosa radius-border form-control" id="idade" name="idade" placeholder="Idade em meses" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class=" form-group">
                                <label for="especie">Animal:</label>
                                <select class="borda-rosa radius-border form-control" id="especie" name="especie" required="required">
                                    <option value="1">Cachorro</option>
                                    <option value="2">Gato</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class=" form-group">
                                <label for="genero">Gênero:</label>
                                <select class="borda-rosa radius-border form-control" id="genero" name="genero" required="required">
                                    <option value="M">Macho</option>
                                    <option value="F">Fêmea</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="porte">Porte:</label>
                                <select class="borda-rosa radius-border form-control" id="porte" name="porte" required="required">
                                    <option value="1">Pequeno</option>
                                    <option value="2">Médio</option>
                                    <option value="3">Grande</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" form-group">
                                <label for="descricao">Características:</label>
                                <textarea class="borda-rosa radius-border form-control" id="descricao" name="descricao" rows="3" placeholder="Informe caracteristicas do seu pet"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" form-group">
                                <label for="narrativa">Motivo da doação:</label>
                                <textarea class="borda-rosa radius-border form-control" id="narrativa" name="narrativa" rows="3" placeholder="Porque está doando seu pet?"></textarea>
                            </div>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="imagem">Imagem do Pet</label>
                                <input type="file" class="form-control-file" id="imagem" name="imagem" required="required">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="criar">
                    <button type="submit" class="borda btn btn-primary" onclick="SendDoacao()"> Cadastrar pet</button>
                </fieldset>
            </form>
        </div>
        <div class="col-md-6 background-vector">
                <center><img class="background-image presente" src="images\vetores\presente.png" alt=""></center>
        </div>
    </div>
</div>

<?php require_once('layout/footer.php'); ?>