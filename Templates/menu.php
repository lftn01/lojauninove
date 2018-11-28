<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
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
        <ul class="navbar-nav">
            <?php if(!isset($_SESSION['usuario'])):?>
                <li class="nav-item">
                    <a class="nav-link" href="/Paginas/login.php">
                        <i class="fa fa-sign-in"></i>
                        Login
                    </a>
                </li>
            <?php else:?>
                <li class="nav-item">
                    <a class="nav-link" href="/Paginas/pedidos.php">
                        <i class="fa fa-shopping-basket"></i>
                        Meus Pedidos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Paginas/carrinho.php">
                        <i class="fa fa-shopping-cart"></i>
                        Carrinho
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Paginas/logout.php">
                        <i class="fa fa-sign-out"></i>
                        Deslogar
                    </a>
                </li>
            <?php endif?>
        </ul>
    </div>
</nav>
