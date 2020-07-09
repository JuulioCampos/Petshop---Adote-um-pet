<?php
namespace App\Controllers;
   
    set_include_path($_SERVER['DOCUMENT_ROOT']);
    require_once('../services/SolicitacaoService.php');
    use App\Services\SolicitacaoService;
    
    

    session_start();    
    $service = new SolicitacaoService();

    if(isset($_POST)){
        switch($_POST['action']){
            case 'exibir':
                $animal = $service->getAll($_POST['id']);
                $_SESSION['animal'] = $animal;
                header('location: ../../animalAlterar.php');
                exit;
            break;
            case 'listar':
                $solicitacoes = $service->getAll();
                $_SESSION['solicitacao'] = $solicitacoes;
                header('location: ../../solicitacaoAlterar.php');
                exit;
            break;
            case 'aprovar':
                $service->approve($_POST['id']);
                $solicitacoes = $service->getAll();
                $_SESSION['solicitacao'] = $solicitacoes;                
                header('location: ../../solicitacaoListar.php');
                exit;
            break;
            case 'reprovar':
                $service->repprove($_POST['id']);
                $solicitacoes = $service->getAll();
                $_SESSION['solicitacao'] = $solicitacoes;                
                header('location: ../../solicitacaoListar.php');
                exit;
            break;
        }
    }   

    header('location: ../../solicitacaoListar.php');


?>