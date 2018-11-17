<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 13/11/2018
 * Time: 22:10
 */

namespace DAO;

use Model\SubCategoria;
use Model\Categoria;
use DAO\CategoriaDAO;


class SubCategoriaDAO extends Banco
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $id
     * @return SubCategoria
     */
    public function getSubCategoria($id){
        $cat_dao = new CategoriaDAO();

        $query = "SELECT id, nome, status, categoria_id FROM sub_categorias WHERE id = ".$id;
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $status, $categoria_id);
        while($stmt->fetch()){
            $sub_categoria = new SubCategoria();
            $sub_categoria->setId($id);
            $sub_categoria->setNome($nome);
            $sub_categoria->setStatus($status);
            $sub_categoria->setCategoria($cat_dao->getCategoria($categoria_id));
        }
        return $sub_categoria;
    }

    /**
     * @return array
     */
    public function getSubCategorias(){
        $cat_dao = new CategoriaDAO();

        $query = "SELECT id, nome, status, categoria_id FROM sub_categorias";
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $status, $categoria_id);
        $sub_categorias = [];
        while($stmt->fetch()){
            $sub_categoria = new SubCategoria();
            $sub_categoria->setId($id);
            $sub_categoria->setNome($nome);
            $sub_categoria->setStatus($status);
            $sub_categoria->setCategoria($cat_dao->getCategoria($categoria_id));
            $sub_categorias[] = $sub_categoria;
        }
        return $sub_categorias;
    }

    /**
     * @param SubCategoria $categoria
     * @return bool
     */
    public function updateSubCategoria(SubCategoria $categoria){
        try{
            $query = "UPDATE sub_categorias SET nome = '".$categoria->getNome()."', status = '".$categoria->getStatus()."', categoria_id = '".$categoria->getCategoria()->getId()."' WHERE id = ".$categoria->getId();
            $stmt = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch(\Exception $e){
            return false;
        }
    }

    /**
     * @param SubCategoria $categoria
     * @return bool
     */
    public function removeSubCategoria(SubCategoria $categoria){
        try{
            $query = "DELETE FROM sub_categorias WHERE id = ".$categoria->getId();
            $stmt = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch(\Exception $e){
            return false;
        }
    }

    /**
     * @param SubCategoria $categoria
     * @return bool
     */
    public function insertSubCategoria(SubCategoria $categoria){
        try{
            $query = "INSERT INTO sub_categorias (nome, status, categoria_id) VALUES ('".$categoria->getNome()."', '".$categoria->getStatus()."', '".$categoria->getCategoria()->getId()."')";
            $stmt = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
}