<?php
include "../../Templates/header-admin.php";
require("../../conexao.php");
session_start();


/*
if (isset($_SESSION['admin'])) {
    echo "Bem-vindo admin: " . $_SESSION['admin'][2];
    unset($_SESSION['usuario']);
} else {
    echo "Você não é administrador";
    unset($_SESSION['admin']);
    session_destroy();
    exit;
}

echo "<br> Pagina do administrador";
 */


if (isset($_POST['update'])) {
// Na hora do UPDATE localiza o registro na tabela categorias.
    $UpdateQuery = "UPDATE sub_categorias SET categoria_id='$_POST[categoria_id]', nome='$_POST[nome]', status='$_POST[status]' WHERE id='$_POST[id]'";
    mysqli_query($conexao, $UpdateQuery);
    echo mysqli_error($conexao);
};



if (isset($_POST['delete'])) {
// Na hora do DELETE localizar o registro pelo ID
    $DeleteQuery = "DELETE FROM sub_categorias WHERE id='$_POST[id]'";
    mysqli_query($conexao, $DeleteQuery);
};

if (isset($_POST['add'])) {
    $AddQuery = "INSERT INTO sub_categorias ( categoria_id, nome) VALUES ('$_POST[categoria_id]', '$_POST[nome]')";
    mysqli_query($conexao, $AddQuery);
    echo mysqli_error($conexao);

};

$sql = "SELECT * FROM categorias";
$myDataCategorias = mysqli_query($conexao, $sql);
$categorias = [];
while ($record = mysqli_fetch_array($myDataCategorias)) {
    $categorias[] = $record;
}

$sql = "SELECT * FROM sub_categorias";
$myData = mysqli_query($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de categorias</title>
 
    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div class="container">


<div class="navbar"><h1 class="h1">Sub Categorias</h1></div>


<?php


echo "<table class='table  table-dark table-striped'>
<thead class='thead-dark'>
<th scope='col'>ID:</th>
<th scope='col'>Categoria</th>
<th scope='col'>Nome:</th>
<th scope='col'>Status:</th>
</thead>
";

while ($record = mysqli_fetch_array($myData)) {
    echo "<form action='' method=post>";
    echo "<tr>";
    echo "<td><input class='form-control disabled'  type=text readonly name=id value='" . $record['id'] . "'></td>";
    echo "<td><select class='form-control' name='categoria_id'>";
    foreach ($categorias as $cat){
        echo "<option ".( $cat['id'] == $record['categoria_id'] ? 'selected' : '' )." value='".$cat['id']."'>".$cat['nome']."</option>";
    }
    echo "</select></td>";

    echo "<td><input class='form-control' type=text name=nome value='" . $record['nome'] . "'></td>";
    echo "<td><input class='form-control' type=text name=status value='" . $record['status'] . "'></td>";
// Esta linha faz com que seja possivel identificar o registro da tabela na hora do UPDATE
    echo "<td><button class='btn btn-warning' type=submit name=update>Atualizar</button></td>";
    echo "<td><button class='btn btn-danger' name=delete >Excluir</button></td>";
    echo "</tr>";
    echo "</form>";
}
// Ultima linha da tabela
echo "</table>";

echo "<h2>Nova categoria</h2>";
echo "<form class='form-inline' action='' method=post>";
echo "<select class='form-control' name='categoria_id'>";
foreach ($categorias as $cat){
    echo "<option value='".$cat['id']."'>".$cat['nome']."</option>";
}
echo "</select></td>";
echo "<input class='form-control' type=text name=nome></td>";
echo "<button class='btn btn-success' type=submit name=add value=Adicionar Registro>Adicionar</button>";
echo "</form>";

?>
</div>


<?php
include "../../Templates/footer-admin.php";
mysqli_close($conexao);
?>
