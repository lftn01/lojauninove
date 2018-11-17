<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 13/11/2018
 * Time: 22:09
 */

namespace Controller;

use Controller\ControllerController;

use DAO\CategoriaDAO;
use Model\Categoria;

class CategoriaController
{
    private $dao;
    private $controller;

    function __construct()
    {
        require_once "../../autoload.php";
        $this->dao = new CategoriaDAO();
        $this->controller = new ControllerController();
    }

    /**
     * @return array
     */
    public function admin_index(){
        return $this->dao->getCategorias();
    }

    /**
     * @param $post
     */
    public function admin_update($post){
        $categoria = new Categoria();
        $categoria->setId($post['id']);
        $categoria->setNome($post['nome']);
        $categoria->setStatus($post['status']);
        if($this->dao->updateCategoria($categoria)){
            $this->controller->redirect("/Admin/categorias/categorias.php?msg=ok");
        }else{
            $this->controller->redirect("/Admin/categorias/categorias.php?msg=error");
        }
    }

    /**
     * @param $post
     */
    public function admin_remove($post){
        $categoria = new Categoria();
        $categoria->setId($post['id']);
        if($this->dao->removeCategoria($categoria)){
            $this->controller->redirect("/Admin/categorias/categorias.php?msg=ok");
        }else{
            $this->controller->redirect("/Admin/categorias/categorias.php?msg=error");
        }
    }

    public function admin_store($post){
        $categoria = new Categoria();
        $categoria->setId($post['id']);
        $categoria->setNome($post['nome']);
        $categoria->setStatus($post['status']);
        if($this->dao->insertCategoria($categoria)){
            $this->controller->redirect("/Admin/categorias/categorias.php?msg=ok");
        }else{
            $this->controller->redirect("/Admin/categorias/categorias.php?msg=error");
        }
    }
}