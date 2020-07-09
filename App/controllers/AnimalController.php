<?php

namespace App\Controllers;   
    set_include_path($_SERVER['DOCUMENT_ROOT']);
    require_once('../services/ArquivoService.php');
    require_once('../services/AnimalService.php');
    use App\Services\ArquivoService;
    use App\Services\AnimalService;

    session_start();    
    $arquivoService = new ArquivoService();


    $service = new AnimalService();
    $service->validate($_POST, $_SESSION['usuario']);    
    if(isset($_POST)){                      
        switch($_POST['action']){
            case 'exibir':
                $animal = $service->getById($_POST['id']);
                $_SESSION['animal'] = $animal;
                header('location: ../../animalAlterar.php');
                exit;
            break;
            case 'alterar':
                $arquivoService->validate($_FILES);
                $imagem = $arquivoService->upload($_SESSION['usuario']);
                $service->setImagem($imagem);
                $service->alter($_SESSION['animal']['id']);
            break;
            case 'criar':
                $arquivoService->validate($_FILES);
                $imagem = $arquivoService->upload($_SESSION['usuario']);
                $service->setImagem($imagem);
                $service->create();
            break;
            case 'deletar':
                $service->delete($_POST['id']);
            break;
            case 'adotar':
                $service->adotar($_POST['id']);
                header('location: ../../index.php');
            break;
        }
    }   

    header('location: ../../animalListar.php');


?>