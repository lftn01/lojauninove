<?php
session_start();
require_once "../../Controller/CategoriaController.php";
$controller = new \Controller\CategoriaController();
$categorias = $controller->admin_index();

if (isset($_POST['update'])) {
    // Na hora do UPDATE localiza o registro na tabela categorias.
    $UpdateQuery = "UPDATE categorias SET nome='$_POST[nome]', status='$_POST[status]' WHERE id='$_POST[id]'";
    mysqli_query($conexao, $UpdateQuery);
    echo mysqli_error($conexao);
};



if (isset($_POST['delete'])) {
// Na hora do DELETE localizar o registro pelo ID
    $DeleteQuery = "DELETE FROM categorias WHERE id='$_POST[id]'";
    mysqli_query($conexao, $DeleteQuery);
};

if (isset($_POST['add'])) {
    $AddQuery = "INSERT INTO categorias ( nome, status) VALUES ('$_POST[nome]',$_POST[status])";
    mysqli_query($conexao, $AddQuery);

};

include "../../Templates/header-admin.php";
?>
<div class="container">
    <div class="navbar"><h1 class="h1">Categorias</h1></div>
    <table class='table  table-dark table-striped'>
        <thead class='thead-dark'>
            <th scope='col'>Id:</th>
            <th scope='col'>Nome:</th>
            <th scope='col'>Status:</th>
        </thead>
        <tbody>
        <?php foreach ($categorias as $c):?>
            <form action='' method=post>
                <tr>
                    <td><input class='form-control'  type=text name=id value='<?php echo $c->getId()?>'></td>
                    <td><input class='form-control' type=text name=nome value='<?php echo $c->getNome()?>'></td>
                    <td><input class='form-control' type=text name=status value='<?php echo $c->getStatus()?>'></td>
                    <td><button class='btn btn-warning' type=submit name=update>Atualizar</button></td>
                    <td><button class='btn btn-danger' name=delete >Excluir</button></td>
                </tr>
            </form>
        <?php endforeach;?>
        <form action='' method=post>
            <tr>
                <td><input class='form-control' type=text name=nome placeholder='nome nova categoria'></td>
                <td><input class='form-control' type=text name=status placeholder='status nova categoria'></td>
                <td colspan='2'><button class='btn btn-success' type=submit name=add value=Adicionar Registro>Adicionar</button></td>
                <td>&nbsp;</td>
            </tr>
        </form>
    </table>
</div>


<?php include "../../Templates/footer-admin.php";?>
