<?php
include_once "./App/Conexao/Conexao.php";
include_once "./App/Dao/SetorDao.php";
include_once "./App/Model/Setor.php";
include_once "./App/Dao/EmpresaDao.php";
include_once "./App/Model/Empresa.php";

//instancia as classes
$setor = new Setor();
$setordao = new SetorDao();

$empresa = new Empresa();
$empresadao = new EmpresaDao();
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
        <form action="App/controller/SetorController.php" method="POST">
            <div class="row">
                <div class="col-md-5">
                    <label>Razao Social</label>
                    <select class="form-control" id="id_empresa" name="id_empresa">
                        <?php foreach($empresadao->read() as $empresa) : ?>
                            <option value="<?=$empresa->getId()?>"><?php echo $empresa->getNomeFantasia()?>  </option>

                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <label>Descricao</label>
                    <input type="text" name="descricao" value="" class="form-control" require />
                </div>
                <div class="col-md-2">
                    <br>
                    <button class="btn btn-primary" type="submit" name="cadastrar">Cadastrar</button>
                </div>
            </div>
        </form>
        <hr>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descricao</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($setordao->read() as $setor) { ?>
                        <tr>
                            <td><?= $setor->getId() ?></td>
                            <td><?= $setor->getDescricao()?></td>
                            <td class="text-center">
                                <button class="btn  btn-warning btn-sm" data-toggle="modal" data-target="#editar><?= $setor->getId() ?>">
                                    Editar
                                </button>
                                <a href="app/controller/EmpresaController.php?del=<?= $setor->getId() ?>">
                                <button class="btn  btn-danger btn-sm" type="button">Excluir</button>
                                </a>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="editar><?= $setor->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="App/controller/SetorController.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Descrição</label>
                                                    <input type="text" name="razaosocial" value="<?= $setor->getDescricao() ?>" class="form-control" require />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Id</label>
                                                    <input type="number" name="id" value="<?= $setor->getId() ?>" readonly class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <br>
                                                    <button class="btn btn-primary" type="submit" name="editar">Cadastrar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>