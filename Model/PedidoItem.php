<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 13/11/2018
 * Time: 21:59
 */

namespace Model;

use Model\Produto;
use Model\Pedido;

class PedidoItem
{
    private $id;
    private $pedido;
    private $produto;
    private $preco;
    private $quantidade;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * @param mixed $pedido
     */
    public function setPedido(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    /**
     * @return mixed
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * @param mixed $produto
     */
    public function setProduto(Produto $produto)
    {
        $this->produto = $produto;
    }

    /**
     * @return mixed
     */
    public function getPreco($format = null)
    {
        if(empty($format))
            return $this->preco;
        else
            return "R$ ".number_format($this->preco, "2", ",", ".");
    }

    public function getTotal($format = null)
    {
        if(empty($format))
            return $this->preco * $this->quantidade;
        else
            return "R$ ".number_format(($this->preco * $this->quantidade), "2", ",", ".");
    }

    /**
     * @param mixed $preco
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    /**
     * @return mixed
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param mixed $quantidade
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

}