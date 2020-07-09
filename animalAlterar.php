<?php require_once 'App\auth.php';

$pagina = "Alterar dados pet";
?> 

<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <form action="App/controllers/AnimalController.php" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend>Doe seu Pet!</legend>
                    <p>Informe os dados do seu animalzinho...</p>
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <img src="images\<?php echo $_SESSION['animal']['imagem']; ?>" class="img-thumbnail">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo $_SESSION['animal']['nome']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="idade">Idade:</label>
                                <input type="text" class="form-control" id="idade" name="idade" placeholder="Idade em meses" value="<?php echo $_SESSION['animal']['idade']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="especie">Animal:</label>
                                <select class="form-control" id="especie" name="especie">
                                    <?php
                                        switch($_SESSION['animal']['especie']){
                                            case 1:
                                                echo '<option value="1" selected="selected">Cachorro</option>';
                                                echo '<option value="2">Gato</option>';
                                            break;
                                            case 2:
                                                echo '<option value="1">Cachorro</option>';
                                                echo '<option value="2" selected="selected">Gato</option>';
                                            break;
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="genero">Gênero:</label>
                                <select class="form-control" id="genero" name="genero">
                                    <?php
                                        switch($_SESSION['animal']['sexo']){
                                            case "M":
                                                echo '<option value="M" selected="selected">Macho</option>';
                                                echo '<option value="F">Fêmea</option>';
                                            break;
                                            case "F":
                                                echo '<option value="M">Macho</option>';
                                                echo '<option value="F" selected="selected">Fêmea</option>';
                                            break;
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="porte">Porte:</label>
                                <select class="form-control" id="porte" name="porte">
                                    <?php
                                        switch($_SESSION['animal']['porte']){
                                            case 1:
                                                echo '<option value="1" selected="selected">Pequeno</option>';
                                                echo '<option value="2">Médio</option>';
                                                echo '<option value="3">Grande</option>"';
                                            break;
                                            case 2:
                                                echo '<option value="1">Pequeno</option>';
                                                echo '<option value="2" selected="selected">Médio</option>';
                                                echo '<option value="3">Grande</option>"';
                                            break;
                                            case 3:
                                                echo '<option value="1">Pequeno</option>';
                                                echo '<option value="2">Médio</option>';
                                                echo '<option value="3" selected="selected">Grande</option>"';
                                            break;
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descricao">Características:</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Informe caracteristicas do seu pet"><?php echo $_SESSION['animal']['descricao']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="narrativa">Narrativa:</label>
                                <textarea class="form-control" id="narrativa" name="narrativa" rows="3" placeholder="Porque está doando seu pet?"><?php echo $_SESSION['animal']['narrativa']; ?></textarea>
                            </div>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="imagem">Imagem do Pet</label>
                                <input type="file" class="form-control-file" id="imagem" name="imagem">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="alterar">
                    <button type="submit" class="btn btn-primary" onclick="SendDoacao()">Alterar</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php require_once('layout/footer.php'); ?>