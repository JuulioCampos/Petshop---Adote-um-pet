<?php

namespace App\Services;  
    //require_once('C:\\Projects\\adopet\\App\\services\\ConnectionService.php');
    require_once('ConnectionService.php');
    
    use App\Services\ConnectionService;
    use Exception;

class AnimalService{

        private $conn;
        private $data;
        private $usuario;

        public function validate($post, $usuario){
            $this->data = [
                'nome' => isset($post['nome']) ? $post['nome'] : null,
                'descricao' => isset($post['descricao']) ? $post['descricao'] : null,
                'idade' => isset($post['idade']) ? $post['idade'] : null,
                'sexo' => isset($post['genero']) ? $post['genero'] : null,
                'porte' => isset($post['porte']) ? $post['porte'] : null,
                'especie' => isset($post['especie']) ? $post['especie'] : null,
                'narrativa' => isset($post['narrativa']) ? $post['narrativa'] : null,
            ];

            $this->usuario = [
                'id' => $usuario['id']
            ];
        }

        public function create(){
            try{
                $this->conn = ConnectionService::connect();
                $this->conn->beginTransaction();
                
                $stmt = $this->conn->prepare("insert into animal (nome, descricao, idade, sexo, porte, especie, imagem, situacao, idusuario) values (:nome, :descricao, :idade, :sexo, :porte, :especie, :imagem, :situacao, :idusuario)");
                $stmt->execute([
                    ':nome' => $this->data['nome'],
                    ':descricao' => $this->data['descricao'],
                    ':idade' => $this->data['idade'],
                    ':sexo' => $this->data['sexo'],
                    ':porte' => $this->data['porte'],
                    ':especie' => $this->data['especie'],
                    ':imagem' => $this->data['imagem'],
                    ':situacao' => 0,
                    ':idusuario' => $this->usuario['id'],
                ]);
                
                $this->data['id'] = $this->conn->lastInsertId();

                $stmt = $this->conn->prepare("insert into solicitacao (idusuario, idanimal, descricao, situacao) values (:idusuario, :idanimal, :descricao, :situacao)");
                $stmt->execute([
                    ':idusuario' => $this->usuario['id'],
                    ':idanimal' => $this->data['id'],
                    ':descricao' => $this->data['narrativa'],
                    ':situacao' => 0,
                ]);

                $this->conn->commit();
            }catch(\Exception $e){
                $this->conn->rollback();
                throw $e->getMessage();
            }
        }

        public function alter($id){
            try{
                $animal = $this->getById($id);                
                $this->conn = ConnectionService::connect();
                $this->conn->beginTransaction();
                
                $stmt = $this->conn->prepare("update animal set nome = :nome, descricao = :descricao, idade = :idade, sexo = :sexo, porte = :porte, especie = :especie, imagem = :imagem where id = :id");
                $stmt->execute([
                    ':nome' => $this->data['nome'],
                    ':descricao' => $this->data['descricao'],
                    ':idade' => $this->data['idade'],
                    ':sexo' => $this->data['sexo'],
                    ':porte' => $this->data['porte'],
                    ':especie' => $this->data['especie'],
                    ':imagem' => is_null($this->data['imagem']) ? $animal['imagem'] : $this->data['imagem'],
                    ':id' => $id,
                ]);
                
                $stmt = $this->conn->prepare("update solicitacao set descricao = :descricao where idanimal = :idanimal");
                $stmt->execute([
                    ':idanimal' => $id,
                    ':descricao' => $this->data['narrativa']
                ]);

                $this->conn->commit();
            }catch(\Exception $e){
                $this->conn->rollback();
                throw $e->getMessage();
            }
        }

        public function getByUsuario($usuarioId){
            try{
                $this->conn = ConnectionService::connect();
                $stmt = $this->conn->prepare("select id, nome, descricao, idade, sexo, porte, especie, imagem, situacao from animal where idusuario = :idusuario");
                $stmt->execute([
                    ':idusuario' => $usuarioId,
                ]);
                $rs = $stmt->fetchAll();
                return $rs;
            }catch(\Exception $e){
                throw $e->getMessage();
            }            
        }

        public function getById($id){
            try{
                $this->conn = ConnectionService::connect();
                $stmt = $this->conn->prepare("select animal.id, animal.nome, animal.descricao, animal.idade, animal.sexo, animal.porte, animal.especie, animal.imagem, animal.situacao, solicitacao.descricao as narrativa from animal inner join solicitacao on solicitacao.idanimal = animal.id where animal.id = :id");
                $stmt->execute([
                    ':id' => $id,
                ]);
                $rs = $stmt->fetchAll();
                return $rs[0];
            }catch(\Exception $e){
                throw $e->getMessage();
            }            
        }

        public function delete($id){
            try{
                $this->conn = ConnectionService::connect();
                $this->conn->beginTransaction();

                $stmt = $this->conn->prepare("delete from solicitacao where idanimal = :id");
                $stmt->execute([
                    'id' => $id
                ]);

                $stmt = $this->conn->prepare("delete from animal where id = :id");
                $stmt->execute([
                    'id' => $id
                ]);

                $this->conn->commit();

            }catch(Exception $e){                
                $this->conn->rollBack();
                throw $e->getMessage();
            }
        }

        public function getAnimal($especie){
            try{
                $this->conn = ConnectionService::connect();
                $stmt = $this->conn->prepare("select animal.id, animal.nome, animal.descricao, animal.idade, animal.sexo, animal.porte, animal.especie, animal.imagem, animal.situacao from animal where animal.especie = :especie and animal.situacao = 1");
                $stmt->execute([
                    ':especie' => $especie,
                ]);
                $rs = $stmt->fetchAll();
                return $rs;
            }catch(\Exception $e){
                throw $e->getMessage();
            }            
        }

        public function setImagem($path){
            $this->data['imagem'] = $path;
        }

        public function adotar($id){
            try{
                $this->conn = ConnectionService::connect();
                
                $stmt = $this->conn->prepare("update animal set situacao = :situacao where id = :id");
                $stmt->execute([
                    ':situacao' => 3,
                    ':id' => $id,
                ]);
            }catch(\Exception $e){
                throw $e->getMessage();
            }
        }
    }
