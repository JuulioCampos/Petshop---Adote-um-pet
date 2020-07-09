<?php

namespace App\Controllers;
    set_include_path($_SERVER['DOCUMENT_ROOT']);
    require_once('../services/LoginService.php');
    use App\Services\LoginService;

    session_start();

    if(isset($_POST['action']) && $_POST['action'] === 'logout'){
        session_destroy();
        header('location: ../../index.php');
        exit;
    }

    if(!empty($_SESSION['usuario'])){
        header('location: ../../index.php');
        exit;
    }
    
    $service = new LoginService();
    $service->validate($_POST);
    $usuario = $service->check();    

    if(!empty($usuario)){        
        $_SESSION['usuario'] = $usuario;
        $_SESSION['admin'] = ($usuario['acesso'] == 1) ? true : 0;
        header('location: ../../index.php');
        exit;
    }

    header('location: ../../registrar.php');
  
