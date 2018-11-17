<?php
require_once "../../Controller/ProdutoController.php";
$controller = new \Controller\ProdutoController();

if (isset($_POST['update'])) {
    $controller->admin_update($_POST, $_FILES);
}



if (isset($_POST['delete'])) {
    $controller->admin_remove($_POST);
}

if (isset($_POST['add'])) {
    $controller->admin_store($_POST, $_FILES);
}

$busca_banco = $controller->admin_index();
$produtos = $busca_banco['produtos'];
$sub_categorias = $busca_banco['sub_categorias'];

include "../../Templates/header-admin.php";
?>
<div class="container">
    <h1 class="h1">Produtos</h1>
    <div class="table-responsive">
        <table class='table  table-dark table-striped'>
            <thead class='thead-dark'>
                <tr>
                    <th scope='col'>Id</th>
                    <th scope='col'>Sub&nbsp;categoria</th>
                    <th scope='col'>Nome</th>
                    <th scope='col'>Descrição</th>
                    <th scope='col'>Preço</th>
                    <th scope='col'>Quantidade</th>
                    <th scope='col'>Foto</th>
                    <th scope='col'>Status<th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($produtos as $p):?>
                    <form action='' method=post>
                    <tr>
                        <td>
                            <input type='hidden' name='id' value='<?php echo $p->getId()?>'>
                            <?php echo $p->getId()?>
                        </td>
                        <td>
                            <select class='form-control' name='sub_categoria_id'>
                                <?php foreach ($sub_categorias as $cat):?>
                                    <option <?php echo  $cat->getId() == $p->getSubCategoria()->getId() ? 'selected' : ''  ?> value='<?php echo $cat->getId()?>'>
                                        <?php echo $cat->getNome()?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                        </td>
                        <td><input class='form-control' type=text name=nome value='<?php echo $p->getNome()?>'></td>
                        <td><input class='form-control' type=text name=descricao value='<?php echo $p->getDescricao()?>'></td>
                        <td><input class='form-control' type=text name=preco value='<?php echo $p->getPreco()?>'></td>
                        <td><input class='form-control' type=text name=quant value='<?php echo $p->getQuantidade()?>'></td>
                        <td><a href='/Uploads/<?php echo $p->getFoto()?>' download><img width='50' src='/Uploads/<?php echo $p->getFoto()?>'></a></td>
                        <td>
                            <select class="form-control" name="status">
                                <option <?php echo $p->getStatus() == 1 ? 'selected' : ''?> value="1">Ativo</option>
                                <option <?php echo $p->getStatus() == 0 ? 'selected' : ''?> value="0">Inativo</option>
                            </select>
                        </td>
                        <td><button class='btn btn-warning' type=submit name=update>Atualizar</button></td>
                        <td><button class='btn btn-danger' name=delete >Excluir</button></td>
                    </tr>
                    </form>
                <?php endforeach;?>
            </tbody>
        </table>
        </div>
            <div class='card'>
                <div class='card-body'>
                    <h2>Novo produto</h2>
                    <form action='' method=post enctype='multipart/form-data'>
                        <div class='form-group'>
                            <label>Sub categoria</label>
                            <select class='form-control' name='sub_categoria_id'>
                            <?php foreach ($sub_categorias as $cat):?>
                                <option value='<?php echo $cat->getId()?>'>
                                    <?php echo $cat->getNome()?>
                                </option>
                            <?php endforeach;?>
                            </select>
                        </div>
                        <div class='form-group'>
                            <label>Nome</label>
                            <input class='form-control' type=text name=nome>
                        </div>
                        <div class='form-group'>
                            <label>Descrição</label>
                            <input class='form-control' type=text name=descricao>
                        </div>
                        <div class='form-group'>
                            <label>Preço</label>
                            <input class='form-control' type=text name=preco>
                        </div>
                        <div class='form-group'>
                            <label>Quantidade</label>
                            <input class='form-control' type=text name=quant>
                        </div>
                        <div class='form-group'>
                            <label>Fotos</label>
                            <input type=file name='foto'>
                        </div>
                        <div class='form-group'>
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                        </div>
                        <button class='btn btn-success' type=submit name=add value=Adicionar Registro>Adicionar</button>
                    </form>
                </div>
            </div>
    </div>
<?php include "../../Templates/footer-admin.php";?>
