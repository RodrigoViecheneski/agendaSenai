<?php
    // Fábrica de conexões
    class Conexao {
        private $usuario;
        private $senha;
        private $banco;
        private $servidor;

        private static $pdo;

        public function __construct(){

            $this->servidor = "localhost";
            $this->banco = "agenda_senai";
            $this->usuario = "root";
            $this->senha = "root";
        }
        public function conectar(){
            try{//Verifica se não há nunhum problema na conexao
                if(is_null(self::$pdo)){
                    self::$pdo = new PDO("mysql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario, $this->senha);
                    //echo "Conectou!!!";
                }
                return self::$pdo;
            }catch(PDOException $ex){
                echo "ERRO: ".$ex->getMessage();
            }
        }
    }
?>