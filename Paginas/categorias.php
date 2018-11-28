<?php
include '../Templates/header.php';
$sub_categorias = $controller->categorias($_GET['id']);
?>
<div class="container-fluid">
    <h1 class="text-center my-3">Escolha um campeonato</h1>
    <div class="row justify-content-center">
        <?php foreach ($sub_categorias as $s):?>
            <div class="col-md-12 col-lg-4">
                <div class="card text-center border-0">
                    <div class="card-body">
                        <h2 class="card-title text-uppercase"><?php echo $s->getNome()?></h2>
                        <img class="img-fluid my-2" src="/img/taca.jpg" alt="Campeonato">
                        <a class="btn btn-warning text-light" href="/Paginas/categorias_detalhes.php?id=<?php echo $s->getId()?>">
                            Conheça os produtos
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>

<?php include '../Templates/footer.php' ?>
