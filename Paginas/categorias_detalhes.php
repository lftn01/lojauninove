<?php
include '../Templates/header.php';
$produtos = $controller->categorias_detalhes($_GET['id']);
?>
<div class="container-fluid">
    <h1 class="text-center my-3">Escolha um campeonato</h1>
    <div class="row">
        <?php foreach ($produtos as $p):?>
            <div class="col-md-12 col-lg-4">
                <div class="card text-center">
                    <img height="250" src="/Uploads/<?php echo $p->getFoto()?>" alt="">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $p->getNome()?></h2>
                        <p class="card-text"><?php echo $p->getPreco("F")?></p>
                        <a class="btn btn-primary" href="/Paginas/categorias_detalhe.php?id=<?php echo $p->getId()?>">
                            Comprar
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>

<?php include '../Templates/footer.php' ?>
