<?php
require_once "../../Controller/AdminController.php";
$controller = new \Controller\AdminController();

if(isset($_POST['add'])){
    $controller->admin_store($_POST);
}

if(isset($_POST['update'])){
    $controller->admin_update($_POST);
}

if(isset($_POST['remover'])){
    $controller->admin_remove($_POST);
}

$admins = $controller->admin_index();

include "../../Templates/header-admin.php"?>
<div class="container-fluid">
    <h1>Administradores</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Status</th>
                <th>Senha</th>
                <th colspan="2">-</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($admins as $a):?>
                <tr>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $a->getId()?>">
                        <td><?php echo $a->getId()?></td>
                        <td>
                            <input class="form-control" type="text" name="nome" value="<?php echo $a->getNome()?>">
                        </td>
                        <td>
                            <input class="form-control" type="email" name="email" value="<?php echo $a->getEmail()?>">
                        </td>
                        <td>
                            <select class="form-control" name="status">
                                <option <?php echo ($a->getStatus() == 1) ? 'selected' : '' ?> value="1">Ativo</option>
                                <option <?php echo ($a->getStatus() == 0) ? 'selected' : '' ?> value="0">Inativo</option>
                            </select>
                        </td>
                        <td>
                            <input class="form-control" type="password" name="nova_senha" placeholder="Nova senha">
                        </td>
                        <td>
                            <button class="btn btn-warning" type="submit" name="update">Atualizar</button>
                        </td>
                    </form>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $a->getId()?>">
                        <td>
                            <button class="btn btn-danger" type="submit" name="remover">Deletar</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>

    <h2>Novo administrador</h2>
    <form class="mb-5" action="" method="post">
        <div class="form-group">
            <label for="">Nome</label>
            <input class="form-control" type="text" name="nome" placeholder="Nome">
        </div>
        <div class="form-group">
            <label for="">E-mail</label>
            <input class="form-control" type="email" name="email" placeholder="E-mail">
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <select class="form-control" name="status">
                <option value="">Selecione um status</option>
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Senha</label>
            <input class="form-control" type="password" name="senha" placeholder="Senha">
        </div>
        <button class="btn btn-success" type="submit" name="add">Cadastrar</button>
    </form>
</div>
<?php include "../../Templates/footer-admin.php"?>
