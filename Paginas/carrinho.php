<?php
    include '../Templates/header.php';
    if(isset($_GET['menos']))
        $carrinhos = $controller->carrinho(null, $_GET['id_carrinho']);
    elseif (isset($_GET['remover']))
        $controller->remover_carrinho($_GET['id_carrinho']);
    else
        $carrinhos = $controller->carrinho(@$_GET['id_produto']);
?>
<div class="container">
    <h1 class="my-3">Carrinho</h1>
    <?php if(sizeof($carrinhos['carrinhos']) > 0):?>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($carrinhos['carrinhos'] as $c):?>
                    <tr>
                        <td><?php echo $c->getProduto()->getNome()?></td>
                        <td><?php echo $c->getProduto()->getPreco(1)?></td>
                        <td>
                            <a class="btn btn-light" href="/Paginas/carrinho.php?id_carrinho=<?php echo $c->getId()?>&menos=1">
                                <i class="fa fa-minus"></i>
                            </a>
                            <?php echo $c->getQuantidade()?>
                            <a class="btn btn-light" href="/Paginas/carrinho.php?id_produto=<?php echo $c->getProduto()->getId()?>">
                                <i class="fa fa-plus"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="/Paginas/carrinho.php?id_carrinho=<?php echo $c->getId()?>&remover=1" alt="remover" title="remover">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
                <tr>
                    <td colspan="3">Total: <?php echo $carrinhos['total']?></td>
                    <td>
                        <a class="btn btn-success" href="/Paginas/checkout.php">Finalizar compra</a>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php else:?>
        <p class="alert alert-danger">Nenhum item no carrinho</p>
    <?php endif?>
</div>

<?php include '../Templates/footer.php' ?>
