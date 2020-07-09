<?php
    require_once( 'layout/main.php');
    
    if(!isset($_SESSION['usuario'])){
        header('location: login.php');
        exit;        
    }    
?>   