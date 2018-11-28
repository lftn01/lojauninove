<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 27/11/2018
 * Time: 21:52
 */

namespace DAO;


use Model\Carrinho;
use Model\Usuario;

class CarrinhoDAO extends Banco
{
    protected $usu_dao;
    protected $pro_dao;
    private $total;
    function __construct()
    {
        parent::__construct();
        $this->usu_dao = new UsuarioDAO();
        $this->pro_dao = new ProdutoDAO();
    }

    /**
     * @return mixed
     */
    public function getTotal($format = null)
    {
        return $format ? "R$ ".number_format($this->total, 2, ',','.') : $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal(Carrinho $carrinho)
    {
        $this->total += $carrinho->getQuantidade() * $carrinho->getProduto()->getPreco();
    }



    /**
     * @param Carrinho $carrinho
     * @return bool
     */
    public function insertCarrinho(Carrinho $carrinho){
        try{
            $query = "INSERT INTO carrinhos (usuario_id, produto_id, quantidade) VALUES (".$carrinho->getUsuario()->getId().", ".$carrinho->getProduto()->getId().", ".$carrinho->getQuantidade().")";
            $stmt = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    /**
     * @param Carrinho $carrinho
     * @return bool
     */
    public function updateCarrinho(Carrinho $carrinho){
        try{
            $query = "UPDATE carrinhos SET usuario_id = ".$carrinho->getUsuario()->getId().", produto_id = ".$carrinho->getProduto()->getId().", quantidade = ".$carrinho->getQuantidade()." WHERE id = ".$carrinho->getId();
            $stmt = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    /**
     * @param Carrinho $carrinho
     * @return bool
     */
    public function removerCarrinho(Carrinho $carrinho){
        try{
            $query = "DELETE FROM carrinhos WHERE id = ".$carrinho->getId();
            $stmt = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    /**
     * @param Usuario $usuario
     * @return array
     */
    public function getCarrinhos(Usuario $usuario){
        $query = "SELECT * FROM carrinhos WHERE usuario_id = ".$usuario->getId();
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $usuario_id, $produto_id, $quantidade);
        $carrinhos = [];
        while($stmt->fetch()){
            $carrinho = new Carrinho();
            $carrinho->setId($id);
            $carrinho->setUsuario($this->usu_dao->getUsuario($usuario_id));
            $carrinho->setProduto($this->pro_dao->getProduto($produto_id));
            $carrinho->setQuantidade($quantidade);
            $this->setTotal($carrinho);
            $carrinhos[] = $carrinho;
        }
        return $carrinhos;
    }

    /**
     * @param $id
     * @return Carrinho
     */
    public function getCarrinhosById($id){
        $query = "SELECT * FROM carrinhos WHERE id = ".$id;
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $usuario_id, $produto_id, $quantidade);
        while($stmt->fetch()){
            $carrinho = new Carrinho();
            $carrinho->setId($id);
            $carrinho->setUsuario($this->usu_dao->getUsuario($usuario_id));
            $carrinho->setProduto($this->pro_dao->getProduto($produto_id));
            $carrinho->setQuantidade($quantidade);
        }
        return $carrinho;
    }
}