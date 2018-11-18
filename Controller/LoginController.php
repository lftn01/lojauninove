<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 18/11/2018
 * Time: 00:22
 */

namespace Controller;


use DAO\AdminDAO;
use Model\Admin;

class LoginController
{
    private $dao;
    private $controller;

    function __construct()
    {
        require_once "../autoload.php";
        $this->dao = new AdminDAO();
        $this->controller = new ControllerController();
    }

    public function admin_login($post){
        $admin = new Admin();
        $admin->setEmail($post['email']);
        $admin->setSenha($post['senha']);
        $admin = $this->dao->getAdminLogin($admin);

        if(!empty($admin->getId())){
            $_SESSION['admin'] = $admin->getId();
            $this->controller->redirect("/Admin/administradores/index.php?msg=ok");
        }else{
            $this->controller->redirect("/Admin/administradores/index.php?msg=error");
        }
    }
}