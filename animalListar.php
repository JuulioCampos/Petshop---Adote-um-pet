<?php
    require_once('App/services/AnimalService.php');

    $pagina = "Listar pets";
    use App\Services\AnimalService;
    
    require_once 'App\auth.php';

    $service = new AnimalService();
    $pets = $service->getByUsuario($_SESSION['usuario']['id']);
?>    

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Idade</th>
                        <th scope="col">Gênero</th>
                        <th scope="col">Porte</th>
                        <th scope="col">Animal</th>
                        <th scope="col">Situacao</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($pets as $p){
                        echo '<tr>';
                        echo '<td>' . $p["nome"] . '</td>';
                        echo '<td>' . $p["idade"] . '</td>';
                        switch($p["sexo"]){
                            case "M":
                                echo '<td>Macho</td>';
                            break;
                            case "F":
                                echo '<td>Fêmea</td>';
                            break;
                        }
                            
                        switch($p["porte"]){
                            case 1:
                                echo '<td>Pequeno</td>';
                            break;
                            case 2:
                                echo '<td>Médio</td>';
                            break;
                            case 3:
                                echo '<td>Grande</td>';
                            break;
                        }

                        switch($p["especie"]){
                            case 1:
                                echo '<td>Cachorro</td>';
                            break;
                            case 2:
                                echo '<td>Gato</td>';
                            break;
                        }

                        switch($p["situacao"]){
                            case 0:
                                echo '<td><p class="badge badge-secondary">Pendente</p></td>';
                            break;
                            case 1:
                                echo '<td><p class="badge badge-primary">Aprovado</p></td>';
                            break;
                            case 2:
                                echo '<td><p class="badge badge-danger">Reprovado</p></td>';
                            break;
                            case 3:
                                echo '<td><p class="badge badge-success">Adotado</p></td>';
                            break;                            
                        }
                        echo '<td>
                                <div class="row">
                                    <div class="col-md-2">
                                        <form action="App\controllers\AnimalController.php" method="POST">
                                            <input type="hidden" name="action" value="exibir">
                                            <input type="hidden" name="id" value="' . $p['id'] . '">
                                            <button type="submit" class="btn btn-primary"><i class="material-icons">create</i></button>
                                        </form>    
                                    </div>
                                    <div class="col-md-2">
                                        <form action="App\controllers\AnimalController.php" method="POST">
                                            <input type="hidden" name="action" value="deletar">
                                            <input type="hidden" name="id" value="' . $p['id'] . '">
                                            <button type="submit" class="btn btn-danger"><i class="material-icons">delete</i></button>
                                        </form>
                                    </div>
                                </div>
                            </td>';
                        
                            echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once('layout/footer.php'); ?>