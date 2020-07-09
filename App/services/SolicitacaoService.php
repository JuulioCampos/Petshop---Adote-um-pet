<?php

namespace App\Services;
  
    //require_once('C:/Projects/adopet/App/services/ConnectionService.php');
    require_once('../services/ConnectionService.php');
    
    use App\Services\ConnectionService;
    use Exception;

class SolicitacaoService {

        public function alter($id){
            try{
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
                    ':imagem' => '', //$this->data['imagem'],
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

        public function getAll(){
            try{
                $this->conn = ConnectionService::connect();
                $stmt = $this->conn->prepare("select s.id, s.dt_transacao, s.descricao as narrativa, s.situacao, u.nome as usuario_nome, a.nome as animal_nome from solicitacao s inner join animal a on a.id = s.idanimal inner join usuario u on u.id = s.idusuario order by s.situacao asc, s.dt_transacao desc");
                $stmt->execute();
                $rs = $stmt->fetchAll();
                return $rs;
            }catch(\Exception $e){
                throw $e->getMessage();
            }
        }

        public function approve($id){
            try{
                $this->conn = ConnectionService::connect();
                $this->conn->beginTransaction();

                $stmt = $this->conn->prepare("update solicitacao set situacao = 1 where id = :id");
                $stmt->execute([
                    'id' => $id
                ]);

                $stmt = $this->conn->prepare("select idanimal as id from solicitacao where id = :id");
                $stmt->execute([
                    'id' => $id
                ]);

                $rs = $stmt->fetchAll();
                $animal = $rs[0];

                $stmt = $this->conn->prepare("update animal set situacao = 1 where id = :id");
                $stmt->execute([
                    'id' => $animal['id']
                ]);

                $this->conn->commit();

            }catch(Exception $e){
                $this->conn->rollBack();
                throw $e->getMessage();
            }
        }

        public function repprove($id){
            try{
                $this->conn = ConnectionService::connect();
                $this->conn->beginTransaction();

                $stmt = $this->conn->prepare("update solicitacao set situacao = 2 where id = :id");
                $stmt->execute([
                    'id' => $id
                ]);

                $stmt = $this->conn->prepare("select idanimal as id from solicitacao where id = :id");
                $stmt->execute([
                    'id' => $id
                ]);

                $rs = $stmt->fetchAll();
                $animal = $rs[0];

                $stmt = $this->conn->prepare("update animal set situacao = 2 where id = :id");
                $stmt->execute([
                    'id' => $animal['id']
                ]);

                $this->conn->commit();

            }catch(Exception  $e){
                $this->conn->rollBack();
                throw $e->getMessage();
            }          
        }

    }
    
