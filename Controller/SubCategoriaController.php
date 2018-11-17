<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 17/11/2018
 * Time: 16:04
 */

namespace Controller;

use Controller\ControllerController;

use DAO\SubCategoriaDAO;
use DAO\CategoriaDAO;
use Model\SubCategoria;

class SubCategoriaController
{
    private $dao;
    private $controller;

    function __construct()
    {
        require_once "../../autoload.php";
        $this->dao = new SubCategoriaDAO();
        $this->cat_dao = new CategoriaDAO();
        $this->controller = new ControllerController();
    }

    /**
     * @return array
     */
    public function admin_index(){
        return [
            'categorias' => $this->cat_dao->getCategorias(),
            'sub_categorias' => $this->dao->getSubCategorias()
        ];
    }

    /**
     * @param $post
     */
    public function admin_update($post){
        $sub_categoria = new SubCategoria();
        $sub_categoria->setId($post['id']);
        $sub_categoria->setNome($post['nome']);
        $sub_categoria->setStatus($post['status']);
        $sub_categoria->setCategoria($this->cat_dao->getCategoria($post['categoria_id']));
        if($this->dao->updateSubCategoria($sub_categoria)){
            $this->controller->redirect("/Admin/sub_categorias/sub_categorias.php?msg=ok");
        }else{
            $this->controller->redirect("/Admin/sub_categorias/sub_categorias.php?msg=error");
        }
    }

    /**
     * @param $post
     */
    public function admin_remove($post){
        $sub_categoria = new SubCategoria();
        $sub_categoria->setId($post['id']);
        if($this->dao->removeSubCategoria($sub_categoria)){
            $this->controller->redirect("/Admin/sub_categorias/sub_categorias.php?msg=ok");
        }else{
            $this->controller->redirect("/Admin/sub_categorias/sub_categorias.php?msg=error");
        }
    }

    /**
     * @param $post
     */
    public function admin_store($post){
        $sub_categoria = new SubCategoria();
        $sub_categoria->setId($post['id']);
        $sub_categoria->setNome($post['nome']);
        $sub_categoria->setStatus($post['status']);
        $sub_categoria->setCategoria($this->cat_dao->getCategoria($post['categoria_id']));
        if($this->dao->insertSubCategoria($sub_categoria)){
            $this->controller->redirect("/Admin/sub_categorias/sub_categorias.php?msg=ok");
        }else{
            $this->controller->redirect("/Admin/sub_categorias/sub_categorias.php?msg=error");
        }
    }
}