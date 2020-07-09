<?php

    function novaConexao($banco = 'adopet'){
        $servidor = 'localhost';
        $usuario = 'root';
        $senha = '';

        $conexao = new mysqli($servidor, $usuario, $senha, $banco);

        if($conexao->connect_error){
            echo ('erro de conexao: '. $conexao->connect_error);
            exit();
        }
        return $conexao;
    }