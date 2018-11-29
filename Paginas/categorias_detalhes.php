<?php
include '../Templates/header.php';
$produtos = $controller->categorias_detalhes($_GET['id']);
?>
<div class="container-fluid">
    <h1 class="text-center my-3">Produtos</h1>
    <div class="row">
        <?php foreach ($produtos as $p):?>
            <div class="col-lg-4 col-md-12">
                <div class="card text-center my-3">
                    <div class="card-body">
                        <h2><?php echo $p->getNome()?></h2>
                        <img class="img-fluid mb-3" src="/Uploads/<?php echo $p->getFoto()?>" alt="<?php echo $p->getNome()?>">
                        <p class="descricao"><?php echo $p->getDescricao()?></p>
                        <p class="text-dark">
                            <strong><?php echo $p->getPreco(1)?></strong>
                        </p>
                        <?php if(isset($_SESSION['usuario'])):?>
                            <a class="btn btn-dark mr-2" href="/Paginas/produto.php?id_produto=<?php echo $p->getId()?>">Ver</a>
                            <a class="btn btn-success" href="/Paginas/carrinho.php?id_produto=<?php echo $p->getId()?>">Comprar</a>
                        <?php else:?>
                            <a class="btn btn-outline-dark mr-2" href="/Paginas/login.php">Logar antes de comprar</a>
                        <?php endif?>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>

<?php include '../Templates/footer.php' ?>
