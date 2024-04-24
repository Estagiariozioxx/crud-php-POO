<?php
include_once "./App/Conexao/Conexao.php";
include_once "./App/Dao/RelatorioDao.php";
include_once "./App/Conexao/Conexao.php";
include_once "./App/Dao/SetorDao.php";
include_once "./App/Model/Setor.php";
include_once "./App/Dao/EmpresaDao.php";
include_once "./App/Model/Empresa.php";

//instancia as classes
$relatoriodao = new RelatorioDao();

$setor = new Setor();
$setordao = new SetorDao();

$empresa = new Empresa();
$empresadao = new EmpresaDao();

$d = filter_input_array(INPUT_POST);
if(!isset($_POST['setor']) && !isset($_POST['id_empresa'])){
    $id_empresa='';
    $id_setor='';
}
else{
    $id_empresa=$_POST['id_empresa'];
    $id_setor=$_POST['setor'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>CRUD Simples PHP</title>
    <style>
        .menu,
        thead {
            background-color: #bbb !important;
        }

        .row {
            padding: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light menu">
        <div class="container">
            <a class="navbar-brand" href="#">
                CRUD PHP POO
            </a>
        </div>
    </nav>
    <div class="container">
    <form action="relatorio.php" method="POST">
            <div class="row">
                <div class="col-md-5">
                    <label>Razao Social</label>
                    <select class="form-control" id="id_empresa" name="id_empresa">
                    <option value="">Todas</option>
                        <?php foreach($empresadao->read() as $empresa) : ?>
                            <option value="<?=$empresa->getId()?>"><?php echo $empresa->getRazaoSocial()?>  </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <label>Setor</label>
                    <select class="form-control" id="setor" name="setor">
                    <option value="">todos</option>
                        <?php foreach($setordao->read() as $setor) : ?>
                            
                            <option value="<?=$setor->getId()?>"><?php echo $setor->getDescricao()?>  </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <br>
                    <button class="btn btn-primary" type="submit" name="buscar">Pesquisar</button>
                </div>
            </div>
        </form>
        <hr>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Setor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $items=$relatoriodao->read($id_empresa,$id_setor);
                   
                        foreach ($items as $item) { ?>
                            <tr>
                                <td><?= $item['RAZAOSOCIAL'] ?></td>
                                <td><?= $item['descricao']?></td>
                            </tr>

                        <?php }?>
                </tbody>
            </table>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>