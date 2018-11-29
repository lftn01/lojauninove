<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 28/11/2018
 * Time: 21:55
 */

namespace DAO;


use Model\Pedido;
use Model\PedidoItem;

class PedidoItemDAO extends Banco
{
    private $table;
    private $orderBy;

    function __construct(){
        parent::__construct();
        $this->setTable("pedido_itens");
        $this->setOrderBy("ORDER BY id ASC");
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @param mixed $orderBy
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @param PedidoItem $item
     * @return bool
     */
    public function insertItem(PedidoItem $item){
        try{
            $query = "INSERT INTO ".$this->getTable()." (pedido_id, produto_id, preco, quantidade) VALUES (".$item->getPedido()->getId().", ".$item->getProduto()->getId().", '".$item->getPreco()."', ".$item->getQuantidade().")";
            $stmt = $this->getConn()->prepare($query);
            $stmt->execute();
            $item->setId($stmt->insert_id);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    /**
     * @param Pedido $pedido
     * @return array
     */
    public function getItens(Pedido $pedido){
        $query = "SELECT * FROM ".$this->getTable()." WHERE pedido_id = ".$pedido->getId();
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $pedido_id, $produto_id, $preco, $quantidade);
        $itens = [];
        $pro_dao = new ProdutoDAO();
        while($stmt->fetch()){
            $item = new PedidoItem();
            $item->setPedido($pedido);
            $item->setProduto($pro_dao->getProduto($produto_id));
            $item->setPreco($preco);
            $item->setQuantidade($quantidade);
            $itens[] = $item;
        }
        return $itens;
    }



}