<?php
include '../Templates/header.php';
$sub_categorias = $controller->categorias($_GET['id']);
?>
<div class="container-fluid">
    <h1 class="text-center my-3">Escolha um campeonato</h1>
    <div class="row">
        <?php foreach ($sub_categorias as $s):?>
            <div class="col-md-12 col-lg-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $s->getNome()?></h2>
                        <a class="btn btn-primary" href="/Paginas/categorias_detalhes.php?id=<?php echo $s->getId()?>">
                            Clique e veja
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>

<?php include '../Templates/footer.php' ?>
