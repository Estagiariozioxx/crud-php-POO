<?php
include_once "../conexao/Conexao.php";
include_once "../Model/Empresa.php";
include_once "../Dao/EmpresaDao.php";

//instancia as classes
$empresa = new Empresa();
$empresadao = new EmpresaDao();

//pega todos os dados passado por POST

$d = filter_input_array(INPUT_POST);

//se a operação for gravar entra nessa condição
if(isset($_POST['cadastrar'])){

    $empresa->setRazaoSocial($d['razaosocial']);
    $empresa->setNomeFantasia($d['nome_fantasia']);
    $empresa->setCnpj($d['cnpj']);

    $empresadao->create($empresa);

    header("Location: ../../");
} 
// se a requisição for editar
else if(isset($_POST['editar'])){

    $empresa->setRazaoSocial($d['razaosocial']);
    $empresa->setNomeFantasia($d['nome_fantasia']);
    $empresa->setCnpj($d['cnpj']);
    $empresa->setId($d['id']);
    $empresadao->update($empresa);

    header("Location: ../../");
}
// se a requisição for deletar
else if(isset($_GET['del'])){

    $empresa->setId($_GET['del']);

    $empresadao->delete($empresa);

    header("Location: ../../");
}else{
    header("Location: ../../");
}