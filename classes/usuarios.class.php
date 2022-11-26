<?php

require_once 'conexao.class.php';

class Usuarios {

    private $con; //variável que recebe a conexao

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $permissoes;//ADD,EDIT,DEL,SUPER

    public function __construct(){
        $this->con = new Conexao();
    }
    /*
    Aqui voês devem fazer o CRUD para usuarios
     -adicionar
     -listar
     -buscar
     -editar
     -excluir
     -existeEmail
    */

    //métodos referentes ao login
    public function fazerLogin($email, $senha){
        $sql = $this->con->conectar()->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $sql->fetch();

            $_SESSION['logado'] = $sql['id'];
            return TRUE;
        }
        return FALSE;
    } 
    public function setUsuario($id) {
        $this->id = $id;
        $sql = $this->con->conectar()->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $sql->fetch();
            $this->permissoes = explode(',', $sql['permissoes']);
        }
    }
    public function getPermissoes(){
        return $this->permissoes;
    }
    public function temPermissoes($p){
        if(in_array($p, $this->permissoes)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}