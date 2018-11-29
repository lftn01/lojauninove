<?php
    include '../Templates/header.php';
    $home = $controller->home();
    ?>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="/img/banner1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/img/banner2.jpg" alt="Second slide">
            </div>
        </div>
    </div>
    <h1 class="text-center text-uppercase my-5">Ofertas</h1>
    <div class="container">
        <div class="row">
            <?php foreach($home['produtos'] as $p):?>
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
