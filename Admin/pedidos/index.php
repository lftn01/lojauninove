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
                <th>Itens do pedido</th>
                <th>Data&nbsp;Criação</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($pedidos as $p):?>
                <tr>
                    <td><?php echo $p->getId()?></td>
                    <td><?php echo $p->getUsuario()->getNome()?></td>
                    <td><?php echo $p->getUsuario()->getEmail()?></td>
                    <td><?php echo $p->getUsuario()->getCpf()?></td>
                    <td><?php echo $p->getPrecoFrete("F")?></td>
                    <td><?php echo $p->getStatus("F")?></td>
                    <td><?php echo $p->getUsuario()->getCep()?></td>
                    <td><?php echo $p->getUsuario()->getLogradouro()?></td>
                    <td><?php echo $p->getUsuario()->getBairro()?></td>
                    <td><?php echo $p->getUsuario()->getEstado()?></td>
                    <td><?php echo $p->getUsuario()->getCidade()?></td>
                    <td><?php echo $p->getUsuario()->getNumero()?></td>
                    <td>
                        <table>
                            <?php foreach($p->getItens() as $it):?>
                                <tr>
                                    <td><?php echo $it->getProduto()->getNome()?>&nbsp;-&nbsp;<?php echo $it->getQuantidade()?>&nbsp;unidades</td>
                                </tr>
                            <?php endforeach?>
                        </table>
                    </td>
                    <td><?php echo $p->getDataCadastro("d/m/Y")?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<?php include "../../Templates/footer-admin.php"?>
