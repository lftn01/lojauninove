<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 17/11/2018
 * Time: 19:14
 */

namespace Controller;

use DAO\AdminDAO;
use Model\Admin;

class AdminController
{
    private $dao;
    private $controller;

    function __construct()
    {
        require_once "../../autoload.php";
        $this->dao = new AdminDAO();
        $this->controller = new ControllerController();
        $this->controller->loginAdmin();
    }

    /**
     * @return array
     */
    public function admin_index(){
        return $this->dao->getAdmins();
    }

    /**
     * @param $post
     */
    public function admin_store($post){
        $admin = new Admin();
        $admin->setNome($post['nome']);
        $admin->setEmail($post['email']);
        $admin->setSenha($post['senha']);
        $admin->setStatus($post['status']);
        if($this->dao->insertAdmin($admin)){
            $this->controller->redirect("/Admin/administradores/index.php?msg=ok");
        }else{
            $this->controller->redirect("/Admin/administradores/index.php?msg=error");
        }
    }

    /**
     * @param $post
     */
    public function admin_update($post){
        $admin = $this->dao->getAdmin($post['id']);
        $admin->setNome($post['nome']);
        $admin->setEmail($post['email']);
        $admin->setStatus($post['status']);
        if(!empty($post['nova_senha'])){
            $admin->setSenha($post['nova_senha']);
        }

        if($this->dao->updateAdmin($admin)){
            $this->controller->redirect("/Admin/administradores/index.php?msg=ok");
        }else{
            $this->controller->redirect("/Admin/administradores/index.php?msg=error");
        }
    }

    /**
     * @param $post
     */
    public function admin_remove($post){
        if($this->dao->removeAdmin($this->dao->getAdmin($post['id']))){
            $this->controller->redirect("/Admin/administradores/index.php?msg=ok");
        }else{
            $this->controller->redirect("/Admin/administradores/index.php?msg=error");
        }
    }
}