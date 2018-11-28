<?php
include '../Templates/header.php';
if(isset($_POST['login']))
    $controller->login($_POST);
?>
<h1 class="text-center text-uppercase my-5">Login</h1>
<div class="container">
    <div class="row">
        <div class="offset-lg-4 offset-md-2 col-lg-4 col-md-10">
            <form class="text-center" action="" method="post">
                <div class="form-group">
                    <label class="sr-only" for="email">E-mail</label>
                    <input class="form-control" type="email" name="email" placeholder="E-mail">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="email">Senha</label>
                    <input class="form-control" type="password" name="senha" placeholder="Senha">
                </div>
                <a class="btn btn-outline-dark" href="/Paginas/cadastro.php">Cadastre-se</a>
                <button class="btn btn-primary" type="submit" name="login">
                    Entrar
                </button>
            </form>
        </div>
    </div>
</div>
<?php include '../Templates/footer.php' ?>
