<?php
require_once "../../Controller/UsuarioController.php";
$controller = new \Controller\UsuarioController();

$usuarios = $controller->admin_index();

include "../../Templates/header-admin.php"?>
<div class="container-fluid">
    <h1>Usuários</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>CPF</th>
                <th>CEP</th>
                <th>Logradouro</th>
                <th>Bairro</th>
                <th>Estado</th>
                <th>Cidade</th>
                <th>Número</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($usuarios as $u):?>
                <tr>
                    <td><?php echo $u->getId()?></td>
                    <td><?php echo $u->getNome()?></td>
                    <td><?php echo $u->getEmail()?></td>
                    <td><?php echo $u->getCpf()?></td>
                    <td><?php echo $u->getCep()?></td>
                    <td><?php echo $u->getLogradouro()?></td>
                    <td><?php echo $u->getBairro()?></td>
                    <td><?php echo $u->getEstado()?></td>
                    <td><?php echo $u->getCidade()?></td>
                    <td><?php echo $u->getNumero()?></td>
                    <td><?php echo ($u->getStatus() == 1) ? 'Ativo' : 'Inativo' ?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<?php include "../../Templates/footer-admin.php"?>
