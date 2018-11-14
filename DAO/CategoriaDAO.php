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

    public function updateCategoria(Categoria $categoria){
        $query = "";
    }
}