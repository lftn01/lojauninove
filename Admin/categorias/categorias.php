<?php
require_once "../../Controller/CategoriaController.php";
$controller = new \Controller\CategoriaController();
$categorias = $controller->admin_index();

if (isset($_POST['update'])) {
    $controller->admin_update($_POST);
}

if (isset($_POST['delete'])) {
    $controller->admin_remove($_POST);
}

if (isset($_POST['add'])) {
    $controller->admin_store($_POST);
}

include "../../Templates/header-admin.php";
?>
<div class="container-fluid">
    <h1 class="h1">Categorias</h1>
    <table class='table table-dark table-striped'>
        <thead class='thead-dark'>
            <th scope='col'>Id</th>
            <th scope='col'>Nome</th>
            <th scope='col'>Status</th>
        </thead>
        <tbody>
        <?php foreach ($categorias as $c):?>
            <form action='' method=post>
                <input type='hidden' name='id' value='<?php echo $c->getId()?>' />
                <tr>
                    <td><?php echo $c->getId()?></td>
                    <td>
                        <input class='form-control' type='text' name='nome' value='<?php echo $c->getNome()?>'>
                    </td>
                    <td>
                        <select class="form-control" name="status">
                            <option <?php echo $c->getStatus() == 1 ? 'selected' : ''?> value="1">Ativo</option>
                            <option <?php echo $c->getStatus() == 0 ? 'selected' : ''?> value="0">Inativo</option>
                        </select>
                    </td>
                    <td>
                        <button class='btn btn-warning' type='submit' name='update'>Atualizar</button>
                    </td>
                    <td>
                        <button class='btn btn-danger' name='delete' >Excluir</button>
                    </td>
                </tr>
            </form>
        <?php endforeach;?>
    </table>
    <hr>
    <h2>Nova categoria</h2>
    <form class="mb-5" action='' method=post>
        <div class="form-group">
            <label for="">Nome</label>
            <input class='form-control' type=text name=nome placeholder='nome nova categoria'>
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <select class="form-control" name="status">
                <option value="">Selecione um status</option>
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
        </div>
        <button class='btn btn-success' type=submit name=add value=Adicionar Registro>Adicionar</button>
    </form>
</div>


<?php include "../../Templates/footer-admin.php";?>
