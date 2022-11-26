<?php
require 'classes/contatos.class.php';
$contato = new Contatos();

if(!empty($_POST['id'])){
    $nome = $_POST['nome'];
    $ddd = $_POST['ddd'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $id = $_POST['id'];

    if(!empty($email)){
        $contato->editar($nome, $ddd, $telefone, $email, $cpf, $endereco, $id);
    }
    header("Location: /agendaSenai");
}