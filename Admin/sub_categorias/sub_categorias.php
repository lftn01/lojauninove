<?php
require_once "../../Controller/SubCategoriaController.php";
$controller = new \Controller\SubCategoriaController();

if (isset($_POST['update'])) {
    $controller->admin_update($_POST);
}

if (isset($_POST['delete'])) {
    $controller->admin_remove($_POST);
}

if (isset($_POST['add'])) {
    $controller->admin_store($_POST);
}

$busca_banco = $controller->admin_index();

$categorias = $busca_banco['categorias'];
$sub_categorias = $busca_banco['sub_categorias'];

include "../../Templates/header-admin.php";
?>
<div class="container">
<h1 class="h1">Sub Categorias</h1>
    <table class='table  table-dark table-striped'>
        <thead class='thead-dark'>
            <tr>
                <th scope='col'>ID:</th>
                <th scope='col'>Categoria</th>
                <th scope='col'>Nome:</th>
                <th scope='col'>Status:</th>
            </tr>
        </thead>

        <?php foreach ($sub_categorias as $sub):?>
            <form action='' method=post>
                <tr>
                    <td>
                        <input type=hidden name=id value='<?php echo $sub->getId()?>'>
                        <?php echo $sub->getId()?>
                    </td>
                    <td>
                        <select class='form-control' name='categoria_id'>
                            <?php foreach ($categorias as $cat):?>
                                <option <?php echo ( $cat->getId() == $sub->getCategoria()->getId() ? 'selected' : '' )?> value='<?php echo $cat->getId()?>'>
                                    <?php echo $cat->getNome()?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </td>
                    <td>
                        <input class='form-control' type=text name=nome value='<?php echo $sub->getNome()?>'>
                    </td>
                    <td>
                        <select class="form-control" name="status">
                            <option <?php echo $sub->getStatus() == 1 ? 'selected' : ''?> value="1">Ativo</option>
                            <option <?php echo $sub->getStatus() == 0 ? 'selected' : ''?> value="0">Inativo</option>
                        </select>
                    </td>
                    <td>
                        <button class='btn btn-warning' type=submit name=update>Atualizar</button>
                    </td>
                    <td>
                        <button class='btn btn-danger' name=delete >Excluir</button>
                    </td>
                </tr>
            </form>
        <?php endforeach;?>
    </table>

    <h2>Nova categoria</h2>
    <form class="mb-5" action='' method=post>
        <label for="">Categoria Pai</label>
        <div class="form-group">
            <select class='form-control' name='categoria_id'>
                <?php foreach ($categorias as $cat):?>
                    <option value='<?php echo $cat->getId()?>'><?php echo $cat->getNome()?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Nome</label>
            <input class='form-control' type=text name=nome>
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
