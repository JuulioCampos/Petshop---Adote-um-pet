<?php

namespace App\Services;
    class ArquivoService{

        private $path;
        private $data;
        private $extensao;

        public function __construct(){
            $this->path = '../../images/';
        }

        public function validate($file){
            $this->extensao = '.' . pathinfo($file[ 'imagem' ][ 'name' ], PATHINFO_EXTENSION);
            $this->data = $file;
        }

        public function upload($usuario){
            $arquivo_name = null;
            if(!empty($this->data['imagem']['tmp_name'])){
                $arquivo_name = $usuario['id'] . '_' . uniqid(time()) . $this->extensao;
                $destino = $this->path . $arquivo_name;
                $arquivo_tmp = $this->data['imagem']['tmp_name'];
                move_uploaded_file($arquivo_tmp, $destino);
            }
        
            return $arquivo_name;
        }

    }
?>