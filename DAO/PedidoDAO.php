<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 20/11/2018
 * Time: 20:33
 */

namespace DAO;


use Model\Pedido;

class PedidoDAO extends Banco
{
    private $table;
    private $orderBy;
    private $usu_dao;

    function __construct(){
        parent::__construct();
        $this->setTable("pedidos");
        $this->setOrderBy("ORDER BY id ASC");
        $this->usu_dao = new UsuarioDAO();
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

    public function getPedidos(){
        $query = "SELECT p.id id_pedido, p.usuario_id, p.preco_frete, p.status, p.data_cadastro FROM ".$this->getTable()." p ".$this->getOrderBy();
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id_pedido, $usuario_id, $preco_frete, $status, $data_cadastro);
        $pedidos = [];
        while ($stmt->fetch()){
            $pedido = new Pedido();
            $pedido->setId($id_pedido);
            $pedido->setUsuario($this->usu_dao->getUsuario($usuario_id));
            $pedido->setPrecoFrete($preco_frete);
            $pedido->setStatus($status);
            $pedido->setDataCadastro($data_cadastro);
            $pedidos[] = $pedido;
        }
        return $pedidos;
    }
}