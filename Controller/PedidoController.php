<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 20/11/2018
 * Time: 20:35
 */

namespace Controller;


use DAO\PedidoDAO;

class PedidoController
{
    private $dao;
    private $controller;

    function __construct()
    {
        require_once "../../autoload.php";
        $this->dao = new PedidoDAO();
        $this->controller = new ControllerController();
        $this->controller->loginAdmin();
    }

    public function admin_index(){
        return $this->dao->getPedidos();
    }
}