<?php
include '../Templates/header.php';
if(isset($_GET['id_pedido'])){
    $pedido = $controller->pedidos_detalhe($_GET['id_pedido']);
}else{
    $pedidos = $controller->pedidos();
}
?>
<div class="container">
    <h1 class="my-3">Pedidos</h1>
    <?php if(!isset($_GET['id_pedido'])):?>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>ID pedido</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($pedidos['pedidos'] as $p):?>
                    <tr>
                        <td><?php echo $p->getId()?></td>
                        <td><?php echo $p->getStatus(1)?></td>
                        <td>
                            <a class="btn btn-primary" href="/Paginas/pedidos.php?id_pedido=<?php echo $p->getId()?>">Ver detalhes</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
   <?php else:?>
        <a class="btn btn-outline-dark mb-3" href="/Paginas/pedidos.php">
            <i class="fa fa-arrow-left"></i>
            Voltar
        </a>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pedido: <?php echo $pedido->getId()?></h5>
                <p><strong>Endereco:</strong> <?php echo $pedido->getUsuario()->getLogradouro().", ".$pedido->getUsuario()->getNumero()." ".$pedido->getUsuario()->getBairro()." ".$pedido->getUsuario()->getCidade().", ".$pedido->getUsuario()->getEstado()." - ".$pedido->getUsuario()->getCep()?></p>
                <p><strong>Status do pedido: </strong><?php echo $pedido->getStatus(1)?></p>
                <p><strong>Data do pedido: </strong><?php echo $pedido->getDataCadastro('d/m/Y')?></p>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach($pedido->getItens() as $it):?>
                    <li class="list-group-item">
                        <?php echo $it->getProduto()->getNome()." - ".$it->getPreco(1)." - quantidade: ".$it->getQuantidade()." - Total produto: ".$it->getTotal(1)?>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
   <?php endif?>
</div>

<?php include '../Templates/footer.php' ?>
