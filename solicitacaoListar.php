<?php
 require_once 'App\auth.php';
 require_once 'App\conexao.php';
 $pagina = "Listar solicitações"; 
 require_once 'App\services\ConnectionService.php';

 $conexao = novaConexao();

$sql = "select s.id, s.dt_transacao, s.descricao as narrativa, s.situacao, u.nome as usuario_nome, a.nome as animal_nome from solicitacao s inner join animal a on a.id = s.idanimal inner join usuario u on u.id = s.idusuario order by s.situacao asc, s.dt_transacao desc";

$resultado = $conexao->query($sql);
$solicitacoes = $_SESSION['solicitacao'];
$solicitacoes = [];

if($resultado->num_rows > 0 ){
    while($row = $resultado->fetch_assoc()){
        $solicitacoes[] = $row;
    }
}else if($conexao->error){
    echo 'Falha: '. $conexao->error;
}
$conexao->close();


?>

    


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Usuário</th>
                        <th scope="col">Animal</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Situacao</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($solicitacoes as $s){
                        echo '<tr>';
                        echo '<td>' .  date("d/m/Y H:m:s", strtotime($s["dt_transacao"])) . '</td>';
                        echo '<td>' . $s["usuario_nome"] . '</td>';
                        echo '<td>' . $s["animal_nome"] . '</td>';
                        echo '<td>' . $s["narrativa"] .'</td>';

                        switch($s["situacao"]){
                            case 0:
                                echo '<td><p class="badge badge-secondary">Pendente</p></td>';
                            break;
                            case 1:
                                echo '<td><p class="badge badge-primary">Aprovado</p></td>';
                            break;
                            case 2:
                                echo '<td><p class="badge badge-danger">Reprovado</p></td>';
                            break;
                        }

                        echo '<td>
                                <div class="row">
                                    <div class="col-md-3">
                                        <form action="App\controllers\SolicitacaoController.php" method="POST">
                                            <input type="hidden" name="action" value="aprovar">
                                            <input type="hidden" name="id" value="' . $s["id"] . '">
                                            <button type="submit" class="btn btn-primary"><i class="material-icons">done</i></button>
                                        </form>    
                                    </div>
                                    <div class="col-md-3">
                                        <form action="App\controllers\SolicitacaoController.php" method="POST">
                                            <input type="hidden" name="action" value="reprovar"> 
                                            <input type="hidden" name="id" value="' . $s["id"] . '">
                                            <button type="submit" class="btn btn-danger"><i class="material-icons">cancel</i></button>
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