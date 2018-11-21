<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 20/11/2018
 * Time: 21:06
 */

namespace Controller;

use DAO\CategoriaDAO;
use DAO\ProdutoDAO;
use DAO\SubCategoriaDAO;

class PageController
{
    private $dao;
    private $controller;

    function __construct()
    {
        require_once "../autoload.php";
        $this->dao = new CategoriaDAO();
        $this->sub_cat_dao = new SubCategoriaDAO();
        $this->pro_dao = new ProdutoDAO();
        $this->controller = new ControllerController();
    }

    /**
     * @return array
     */
    public function index(){
        return [
            "categorias" => $this->dao->getCategorias()
        ];
    }

    /**
     * @param $categoria_id
     * @return array
     */
    public function categorias($categoria_id){
        return $this->sub_cat_dao->getSubCategoriasByCategoria($categoria_id);
    }

    public function categorias_detalhes($sub_categoria_id){
        return $this->pro_dao->getProdutosByCategoria($sub_categoria_id);
    }
}