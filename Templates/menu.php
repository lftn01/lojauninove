<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo empty($_GET['id']) ? 'active' : '' ?>">
                <a class="nav-link" href="/Paginas/home.php">
                    <i class="fa fa-home"></i>
                    Home
                </a>
            </li>
            <?php foreach($page['categorias'] as $cat):?>
                <li class="nav-item <?php echo $cat->getId() == @$_GET["id"] ? 'active' : '' ?>">
                    <a class="nav-link" href="/Paginas/categorias.php?id=<?php echo $cat->getId()?>"><?php echo $cat->getNome()?></a>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
</nav>
