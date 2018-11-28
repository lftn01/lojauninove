<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 17/11/2018
 * Time: 17:46
 */

namespace DAO;
use Model\Produto;

class ProdutoDAO extends Banco{
    function __construct()
    {
        parent::__construct();
    }

    public function getProdutosByCategoria($categoria_id){
        $query = "SELECT * FROM produtos WHERE sub_categoria_id = ".$categoria_id;
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $sub_categoria_id, $nome, $descricao, $preco, $quantidade, $foto, $status, $oferta);
        $produtos = [];
        $sub_dao = new SubCategoriaDAO();
        while($stmt->fetch()){
            $produto = new Produto();
            $produto->setId($id);
            $produto->setSubCategoria($sub_dao->getSubCategoria($sub_categoria_id));
            $produto->setNome($nome);
            $produto->setDescricao($descricao);
            $produto->setPreco($preco);
            $produto->setQuantidade($quantidade);
            $produto->setFoto($foto);
            $produto->setStatus($status);
            $produto->setOferta($oferta);
            $produtos[] = $produto;
        }

        return $produtos;
    }

    /**
     * @param null $oferta
     * @return array
     */
    public function getProdutos($oferta = null){
        $query = "SELECT * FROM produtos".( $oferta ? " WHERE oferta = 1" : "");
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $sub_categoria_id, $nome, $descricao, $preco, $quantidade, $foto, $status, $oferta);
        $produtos = [];
        $sub_dao = new SubCategoriaDAO();
        while($stmt->fetch()){
            $produto = new Produto();
            $produto->setId($id);
            $produto->setSubCategoria($sub_dao->getSubCategoria($sub_categoria_id));
            $produto->setNome($nome);
            $produto->setDescricao($descricao);
            $produto->setPreco($preco);
            $produto->setQuantidade($quantidade);
            $produto->setFoto($foto);
            $produto->setStatus($status);
            $produto->setOferta($oferta);
            $produtos[] = $produto;
        }

        return $produtos;
    }

    /**
     * @param $id
     * @return Produto
     */
    public function getProduto($id){
        $query = "SELECT * FROM produtos WHERE id = ".$id;
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $sub_categoria_id, $nome, $descricao, $preco, $quantidade, $foto, $status,$oferta);
        $sub_dao = new SubCategoriaDAO();
        while($stmt->fetch()){
            $produto = new Produto();
            $produto->setId($id);
            $produto->setSubCategoria($sub_dao->getSubCategoria($sub_categoria_id));
            $produto->setNome($nome);
            $produto->setDescricao($descricao);
            $produto->setPreco($preco);
            $produto->setQuantidade($quantidade);
            $produto->setFoto($foto);
            $produto->setStatus($status);
            $produto->setOferta($oferta);
        }

        return $produto;
    }

    /**
     * @param Produto $produto
     * @return bool
     */
    public function insertProduto(Produto $produto){
        try{
            $query = "INSERT INTO produtos (sub_categoria_id, nome, descricao, preco, quantidade, foto, status) VALUES ".
                "('".$produto->getSubCategoria()->getId()."', '".$produto->getNome()."', '".$produto->getDescricao()."', '".$produto->getPreco()."', '".$produto->getQuantidade()."', '".$produto->getFoto()."', '".$produto->getStatus()."')";
            $stmt  = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    /**
     * @param Produto $produto
     * @return bool
     */
    public function updateProduto(Produto $produto){
        try{
            $query = "UPDATE produtos SET sub_categoria_id = '".$produto->getSubCategoria()->getId()."', nome = '".$produto->getNome()."', descricao = '".$produto->getDescricao()."', preco = '".$produto->getPreco()."', quantidade = '".$produto->getQuantidade()."', foto = '".$produto->getFoto()."', status = '".$produto->getStatus().", oferta = '".$produto->getOferta()."' WHERE id = ".$produto->getId();
            $stmt  = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function removeProduto(Produto $produto){
        try{
            $query = "DELETE FROM produtos WHERE id = ".$produto->getId();
            $stmt  = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch (\Exception $e){
            return false;
        }
    }
}