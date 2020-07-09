<?php

namespace App;
    class Usuario {
        public $id;
        public $nome;
        public $sobrenome;
        public $email;
        public $acesso;

        public static function assoc($data){
            $u = new Usuario();
            if(!empty($data)){
                $u->id = $data['id'];
                $u->nome = $data['nome'];
                $u->sobrenome = $data['sobrenome'];
                $u->email = $data['email'];
                $u->acesso = $data['acesso'];            
            }            
            return $u;
        }

        public function isEmpty(){
            if( $this->id === null &&
                $this->nome === null &&
                $this->sobrenome === null &&
                $this->email === null &&
                $this->acesso === null){
                return true;    
            }
            return false;
        }
    }

?>