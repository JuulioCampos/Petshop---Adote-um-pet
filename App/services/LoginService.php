<?php

namespace App\Services;
    //require_once('C:\\Projects\\adopet\\App\\services\\ConnectionService.php');
    require_once('../services/ConnectionService.php');
    require_once('../Usuario.php');

    use App\Services\ConnectionService;
    use App\Usuario;

    class LoginService{
        private $conn;
        private $data;
        private $login;

        private function login(){
            try{
                $this->conn = ConnectionService::connect();
                $stmt = $this->conn->prepare("select id, nome, sobrenome, email, acesso from usuario where email = :email and senha = :senha");
                $stmt->execute([
                    'email' => $this->data['email'],
                    'senha' => $this->data['senha']
                ]);
                $rs = $stmt->fetchAll();
                return $rs[0];
            }catch(\Exception $e){
                throw $e->getMessage();
            }
        }

        private function register(){
            try{
                $this->conn = ConnectionService::connect();
                $stmt = $this->conn->prepare("insert into usuario (nome, sobrenome, email, senha, acesso) values (:nome, :sobrenome, :email, :senha, :acesso)");
                $stmt->execute([
                    ':nome' => $this->data['nome'],
                    ':sobrenome' => $this->data['sobrenome'],
                    ':email' => $this->data['email'],
                    ':senha' => $this->data['senha'],
                    ':acesso' => $this->data['acesso']
                ]);
            }catch(\Exception $e){
                throw $e->getMessage();
            }            
        }

        public function check(){
            if(!$this->login)
                $this->register();

            return $this->login();
        }

        public function validate($post){
            $this->data = array();
            if(isset($post)){
                if($post['action'] === "registrar"){
                    $this->login = false;
                    $this->data = [
                        'nome' => $post['nome'],
                        'sobrenome' => $post['sobrenome'],
                        'email' => $post['email'],
                        'senha' => base64_encode($post['senha']),
                        'acesso' => (isset($post['admin'])) ? 1 : 0
                    ];
                }else if($post['action'] === "login"){
                    $this->login = true;
                    $this->data = [
                        'email' => $post['email'],
                        'senha' => base64_encode($post['senha']),
                    ];
                }
            }
        }

        private function find(){
            try{
                $this->conn = ConnectionService::connect();
                $rs = $this->conn->prepare("select id, nome, sobrenome, email, acesso from usuario where email = :email");
                $rs->execute([
                    ':email' => $this->data['email'],
                ]);
                return Usuario::assoc($rs->fetchAll());
                //return $this->conn->fetchObject('App\\Usuario.php');
            }catch(\Exception $e){
                throw $e->getMessage();
            }                    
        }
    }
 

?>