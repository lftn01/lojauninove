<?php
require_once "../../Controller/PedidoController.php";
$controller = new \Controller\PedidoController();

$pedidos = $controller->admin_index();

include "../../Templates/header-admin.php"?>
<div class="container-fluid">
    <h1>Pedidos</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID&nbsp;Pedido</th>
                <th>Nome&nbsp;Usuário</th>
                <th>E-mail</th>
                <th>CPF</th>
                <th>Frete</th>
                <th>Status&nbsp;Pedido</th>
                <th>CEP</th>
                <th>Logradouro</th>
                <th>Bairro</th>
                <th>Estado</th>
                <th>Cidade</th>
                <th>Número</th>
                <th>Data&nbsp;Criação</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($pedidos as $p):?>
                <tr>
                    <th><?php echo $p->getId()?></th>
                    <th><?php echo $p->getUsuario()->getNome()?></th>
                    <th><?php echo $p->getUsuario()->getEmail()?></th>
                    <th><?php echo $p->getUsuario()->getCpf()?></th>
                    <th><?php echo $p->getPrecoFrete("F")?></th>
                    <th><?php echo $p->getStatus("F")?></th>
                    <th><?php echo $p->getUsuario()->getCep()?></th>
                    <th><?php echo $p->getUsuario()->getLogradouro()?></th>
                    <th><?php echo $p->getUsuario()->getBairro()?></th>
                    <th><?php echo $p->getUsuario()->getEstado()?></th>
                    <th><?php echo $p->getUsuario()->getCidade()?></th>
                    <th><?php echo $p->getUsuario()->getNumero()?></th>
                    <th><?php echo $p->getDataCadastro("d/m/Y")?></th>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<?php include "../../Templates/footer-admin.php"?>
