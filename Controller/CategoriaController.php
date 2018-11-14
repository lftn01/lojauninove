<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 13/11/2018
 * Time: 22:09
 */

namespace Controller;

use DAO\CategoriaDAO;

class CategoriaController
{
    private $dao;
    function __construct()
    {
        require_once "../../autoload.php";
        $this->dao = new CategoriaDAO();
    }

    /**
     * @return array
     */
    public function admin_index(){
        return $this->dao->getCategorias();
    }
}