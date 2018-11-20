<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 20/11/2018
 * Time: 20:22
 */

namespace Controller;


use DAO\UsuarioDAO;

class UsuarioController
{
    private $dao;
    private $controller;

    function __construct()
    {
        require_once "../../autoload.php";
        $this->dao = new UsuarioDAO();
        $this->controller = new ControllerController();
        $this->controller->loginAdmin();
    }

    public function admin_index(){
        return $this->dao->getUsuarios();
    }
}