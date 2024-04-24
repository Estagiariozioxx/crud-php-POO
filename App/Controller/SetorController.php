<?php
include_once "../conexao/Conexao.php";
include_once "../Model/Setor.php";
include_once "../Dao/SetorDao.php";


$setor = new Setor();
$setordao = new SetorDao();

$d = filter_input_array(INPUT_POST);


if(isset($_POST['cadastrar'])){

    $setor->setDescricao($d['descricao']);

    $setordao->create($setor,$d['id_empresa']);

    header("Location: ../../cad-setor.php");
} 

else if(isset($_POST['editar'])){

    $setor->setDescricao($d['descricao']);
    $setor->setId($d['id']);
    $setordao->update($setor);

    header("Location: ../../cad-setor.php");
}

else if(isset($_GET['del'])){

    $setor->setId($_GET['del']);

    $setordao->delete($setor);

    header("Location: ../../cad-setor.php");
}else{
    header("Location: ../../cad-setor.php");
}