<?php
include 'classes/contatos.class.php';
$contato = new Contatos();

if(!empty($_POST['email'])){
    $nome = $_POST['nome'];
    $ddd = $_POST['ddd'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];

    $contato->adicionar($email, $nome, $ddd, $telefone, $cpf, $endereco);
    header('Location: index.php');

}else{
    echo '<script type="text/javascript">alert("Email já cadastrado!");</script>';
}
?>