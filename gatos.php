<?php
    require_once( 'layout/main.php');
    require_once('App/services/AnimalService.php');
    $pagina = "Adoção de gatos"; 
    use App\Services\AnimalService;
    
    $service = new AnimalService();
    $pets = $service->getAnimal(2);
?>    

<div class="container-fluid img-pets">
    <div class="row">
        <?php
            foreach($pets as $p){
                echo '
                <div class="col-sm-3 col-md-3">
                    <div class="card" style="width: 18rem;">';
                echo '<img src="images/' . $p['imagem'] . '" class="img-thumbnail">';
                echo '<div class="card-body">
                            <h5 class="card-title">' . $p['nome'] . '</h5>';
                echo        '<p class="card-text">Idade: ' . $p['idade'] . ' mes(es)</p>';
    
                switch($p["sexo"]){
                    case "M":
                        echo '<p class="card-text">Gênero: Macho</p>';
                    break;
                    case "F":
                        echo '<p class="card-text">Gênero: Fêmea</p>';
                    break;                    
                }
                
                switch($p["porte"]){
                    case 1:
                        echo '<p class="card-text">Porte: Pequeno</p>';
                    break;
                    case 2:
                        echo '<p class="card-text">Porte: Médio</p>';
                    break;
                    case 3:
                        echo '<p class="card-text">Porte: Grande</p>';
                    break;
                }
                echo        '<form action="App\controllers\AnimalController.php" method="POST">
                                <input type="hidden" name="action" value="adotar">
                                <input type="hidden" name="id" value="' . $p["id"] . '">
                                <button type="submit" class="btn btn-primary">Adotar!</button>
                            </form>   
                        </div>
                    </div>
                </div>';
            }
        ?>
    </div>
</div>

<?php require_once('layout/footer.php'); ?>    