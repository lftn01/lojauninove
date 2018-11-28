<?php
    include '../Templates/header.php';
    $produto = $controller->produto();?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 mt-3">
            <h1 class="text-uppercase"><?php echo $produto->getNome()?></h1>
        </div>
        <div class="col-lg-4 col-md-12">
            <img class="img-fluid" src="/Uploads/<?php echo $produto->getFoto()?>" alt="<?php echo $produto->getNome()?>">
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text"><?php echo $produto->getDescricao()?></p>
                </div>
            </div>
            <p>
                <strong><?php echo $produto->getPreco(1)?></strong>
            </p>
            <a class="btn btn-success" href="/Paginas/carrinho.php?id_produto=<?php echo $produto->getId()?>">
                Comprar
            </a>
        </div>
    </div>
</div>

<?php include '../Templates/footer.php' ?>
