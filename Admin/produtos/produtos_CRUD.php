<?php
include "../../Templates/header-admin.php";
require("../../conexao.php");
define('DIRETORIO', $diretorio = $_SERVER['DOCUMENT_ROOT']."/Uploads/");

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
    $UpdateQuery = "UPDATE produtos SET nome='$_POST[nome]', descricao='$_POST[descricao]', preco='$_POST[preco]', quantidade='$_POST[quant]', foto='$_POST[foto]', status='$_POST[status]' WHERE id='$_POST[id]'";
    mysqli_query($conexao, $UpdateQuery);
};



if (isset($_POST['delete'])) {
// Na hora do DELETE localizar o registro pelo ID
    $DeleteQuery = "DELETE FROM produtos WHERE id='$_POST[id]'";
    mysqli_query($conexao, $DeleteQuery);
};

if (isset($_POST['add'])) {
    //upload de foto
    $arquivo = time().".png";
    move_uploaded_file($_FILES['foto']['tmp_name'],DIRETORIO.$arquivo);


    $AddQuery = "INSERT INTO produtos ( sub_categoria_id, nome, descricao, preco, quantidade, foto, status) VALUES ('$_POST[sub_categoria_id]','$_POST[nome]','$_POST[descricao]','$_POST[preco]','$_POST[quant]','$arquivo',$_POST[status])";
    mysqli_query($conexao, $AddQuery);
    echo mysqli_error($conexao);
};


$sql = "SELECT * FROM sub_categorias";
$myDataCategorias = mysqli_query($conexao, $sql);
$sub_categorias = [];
while ($record = mysqli_fetch_array($myDataCategorias)) {
    $sub_categorias[] = $record;
}

$sql = "SELECT * FROM produtos";
$myData = mysqli_query($conexao, $sql);


//unlink(DIRETORIO."1541032418.png");
?>
<div class="container">


    <div class="navbar"><h1 class="h1">Produtos</h1></div>

<div class="table-responsive">
    <?php


    echo "<table class='table  table-dark table-striped'>
<thead class='thead-dark'>
<th scope='col'>Id:</th>
<th scope='col'>Sub&nbsp;categoria:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th scope='col'>Nome:</th>
<th scope='col'>Descrição:</th>
<th scope='col'>Preço</th>
<th scope='col'>Quantidade</th>
<th scope='col'>Foto</th>
<th scope='col'>Status<th>
</thead>
";

    while ($record = mysqli_fetch_array($myData)) {
        echo "<form action='' method=post>";
        echo "<tr>";
        echo "<td><input class='form-control'  type=text name=id value='" . $record['id'] . "'></td>";
        echo "<td><select class='form-control' name='sub_categoria_id'>";
        foreach ($sub_categorias as $cat){
            echo "<option ".( $cat['id'] == $record['sub_categoria_id'] ? 'selected' : '' )." value='".$cat['id']."'>".$cat['nome']."</option>";
        }
        echo "</select></td>";
        echo "<td><input class='form-control' type=text name=nome value='" . $record['nome'] . "'></td>";
        echo "<td><input class='form-control' type=text name=descricao value='" . $record['descricao'] . "'></td>";
        echo "<td><input class='form-control' type=text name=preco value='" . $record['preco'] . "'></td>";
        echo "<td><input class='form-control' type=text name=quant value='" . $record['quantidade'] . "'></td>";
        echo "<td><a href='/Uploads/".$record['foto']."' download><img width='50' src='/Uploads/".$record['foto']."'></a></td>";
        echo "<td><input class='form-control' type=text name=status value='" . $record['status'] . "'></td>";
// Esta linha faz com que seja possivel identificar o registro da tabela na hora do UPDATE
        echo "<td><button class='btn btn-warning' type=submit name=update>Atualizar</button></td>";
        echo "<td><button class='btn btn-danger' name=delete >Excluir</button></td>";
        echo "</tr>";
        echo "</form>";
    }
    echo "</table>";


    ?>
</div>
    <?php

    echo "<div class='card'>";
    echo "<div class='card-body'>";
    // Ultima linha da tabela
    echo "<h2>Novo produto</h2>";
    echo "<form action='' method=post enctype='multipart/form-data'>";
    echo "<div class='form-group'>";
    echo "<label>Sub categoria</label>";
    echo "<select class='form-control' name='sub_categoria_id'>";
    foreach ($sub_categorias as $cat){
        echo "<option value='".$cat['id']."'>".$cat['nome']."</option>";
    }
    echo "</select>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label>Nome</label>";
    echo "<input class='form-control' type=text name=nome>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label>Descrição</label>";
    echo "<input class='form-control' type=text name=descricao>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label>Preço</label>";
    echo "<input class='form-control' type=text name=preco>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label>Quantidade</label>";
    echo "<input class='form-control' type=text name=quant>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label>Fotos</label>";
    echo "<input type=file name='foto'>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label>Status</label>";
    echo "<input class='form-control' type=text name=status>";
    echo "</div>";
    echo "<button class='btn btn-success' type=submit name=add value=Adicionar Registro>Adicionar</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";

    ?>
</div>
    <?php
    include "../../Templates/footer-admin.php";
mysqli_close($conexao);

?>
