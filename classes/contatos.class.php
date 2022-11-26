<?php
require_once 'conexao.class.php';

class Contatos{
    private $id;
    private $nome;
    private $ddd;
    private $telefone;
    private $email;
    private $cpf;
    private $endereco;

    private $con;

    public function __construct(){
        $this->con = new Conexao();
    }

    public function adicionar($email, $nome, $ddd, $telefone, $cpf, $endereco){
        $emailExistente = $this->existeEmail($email);
        if(count($emailExistente) == 0){
            try{
                $this->nome = $nome;
                $this->ddd = $ddd;
                $this->telefone = $telefone;
                $this->email = $email;
                $this->cpf = $cpf;
                $this->endereco = $endereco;
                $sql = $this->con->conectar()->prepare("INSERT INTO contatos(nome, ddd, telefone, email, cpf, endereco) VALUES(:nome, :ddd, :telefone, :email, :cpf, :endereco)");
                $sql->bindValue(":nome", $nome);
                $sql->bindValue(":ddd", $ddd);
                $sql->bindValue(":telefone", $telefone);
                $sql->bindValue(":email", $email);
                $sql->bindValue(":cpf", $cpf);
                $sql->bindValue(":endereco", $endereco);
                $sql->execute();
                return TRUE;
            }catch(PDOException $ex){
                return 'ERRO: '.$ex->getMessage();
            }
        }else{
            return FALSE;
        }

    }
    private function existeEmail($email){
        $sql = $this->con->conectar()->prepare("SELECT id FROM contatos WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }else{
            $array = array();
        }
        return $array;
    }
    public function listar(){
        try{
            $sql = $this->con->conectar()->prepare("SELECT id, nome, ddd, telefone, email, cpf, endereco FROM contatos");
            $sql->execute();
            return $sql->fetchAll();
        }catch(PDOException $ex){
            return 'ERRO: '.$ex->getMessage();
        }
    }
    public function busca($id){
        try{
            $sql = $this->con->conectar()->prepare("SELECT * FROM contatos WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            if($sql->rowCount() > 0){
                return $sql->fetch();
            }else{
                return array();
            }
        }catch(PDOException $ex){
            echo "ERRO: ".$ex->getMessage();
        }
    }
    public function editar($nome, $ddd, $telefone, $email, $cpf, $endereco, $id){
        $emailExistente = $this->existeEmail($email);
        if(count($emailExistente) > 0 && $emailExistente['id'] != $id){
            return FALSE;
        }else{
            try{
                $sql = $this->con->conectar()->prepare("UPDATE contatos SET nome = :nome, ddd = :ddd, telefone = :telefone, email = :email, cpf = :cpf, endereco = :endereco WHERE id = :id");
                $sql->bindValue(':nome', $nome);
                $sql->bindValue(':ddd', $ddd);
                $sql->bindValue(':telefone', $telefone);
                $sql->bindValue(':email', $email);
                $sql->bindValue(':cpf', $cpf);
                $sql->bindValue(':endereco', $endereco);
                $sql->bindValue(':id', $id);
                $sql->execute();
                return TRUE;
            }catch(PDOException $ex){
                echo "ERRO: ".$ex->getMessage();
            }
        }

    }
    public function excluir($id){
        $sql = $this->con->conectar()->prepare("DELETE FROM contatos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}
