<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 13/11/2018
 * Time: 22:10
 */

namespace DAO;

use DAO\Banco;
use Model\Categoria;

class CategoriaDAO extends Banco
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $id
     * @return Categoria
     */
    public function getCategoria($id){
        $query = "SELECT id, nome, status FROM categorias WHERE id = ".$id;
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $status);
        while($stmt->fetch()){
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria->setNome($nome);
            $categoria->setStatus($status);
        }
        return $categoria;
    }

    /**
     * @return array
     */
    public function getCategorias(){
        $query = "SELECT id, nome, status FROM categorias";
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $status);
        $categorias = [];
        while($stmt->fetch()){
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria->setNome($nome);
            $categoria->setStatus($status);
            $categorias[] = $categoria;
        }
        return $categorias;
    }

    /**
     * @param Categoria $categoria
     * @return bool
     */
    public function updateCategoria(Categoria $categoria){
        try{
            $query = "UPDATE categorias SET nome = '".$categoria->getNome()."', status = '".$categoria->getStatus()."' WHERE id = ".$categoria->getId();
            $stmt = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch(\Exception $e){
            return false;
        }
    }

    /**
     * @param Categoria $categoria
     * @return bool
     */
    public function removeCategoria(Categoria $categoria){
        try{
            $query = "DELETE FROM categorias WHERE id = ".$categoria->getId();
            $stmt = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch(\Exception $e){
            return false;
        }
    }

    /**
     * @param Categoria $categoria
     * @return bool
     */
    public function insertCategoria(Categoria $categoria){
        try{
            $query = "INSERT INTO categorias (nome, status) VALUES ('".$categoria->getNome()."', '".$categoria->getStatus()."')";
            $stmt = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
}