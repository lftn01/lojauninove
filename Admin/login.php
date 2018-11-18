<?php
    require_once "../Controller/LoginController.php";
    $controller = new \Controller\LoginController();
    if(isset($_POST['login'])){
        $controller->admin_login($_POST);
    }
    include "../Templates/header-login.php";
?>
<div class="offset-4 col-md-4">
    <h1 class="text-center text-light mt-5">Login</h1>
    <form class="text-center" action="" method="post">
        <div class="form-group">
            <label class="sr-only" for="">E-mail</label>
            <input class="form-control border-0" type="email" name="email" placeholder="E-mail">
        </div>
        <div class="form-group">
            <label class="sr-only" for="">Senha</label>
            <input class="form-control border-0" type="password" name="senha" placeholder="Senha">
        </div>
        <button class="btn btn-block btn-primary" type="submit" name="login">
            Logar
        </button>
    </form>
</div>
<?php include "../Templates/footer-login.php";?>
