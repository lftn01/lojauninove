<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 17/11/2018
 * Time: 17:46
 */

namespace Controller;

use DAO\ProdutoDAO;
use DAO\SubCategoriaDAO;
use Model\Produto;

class ProdutoController
{
    private $dao;
    private $cat_dao;
    private $controller;

    function __construct()
    {
        require_once "../../autoload.php";
        $this->dao = new ProdutoDAO();
        $this->cat_dao = new SubCategoriaDAO();
        $this->controller = new ControllerController();
        $this->controller->loginAdmin();
    }

    /**
     * @return array
     */
    public function admin_index(){
        return [
            'produtos' => $this->dao->getProdutos(),
            'sub_categorias' => $this->cat_dao->getSubCategorias()
        ];
    }
    public function admin_update($post, $file = null){
        $produto = $this->dao->getProduto($post['id']);
        $produto->setId($post['id']);
        $produto->setSubCategoria($this->cat_dao->getSubCategoria($post['sub_categoria_id']));
        $produto->setNome($post['nome']);
        $produto->setDescricao($post['descricao']);
        $produto->setPreco($post['preco']);
        $produto->setQuantidade($post['quant']);
        $produto->setStatus($post['status']);
        if(!empty($file)) {
            try {
                $produto->setFoto(time() . ".png");
                move_uploaded_file($file['foto']['tmp_name'], $produto->diretorio . $produto->getFoto());
            } catch (\Exception $e) {
                $produto->setFoto("produto-padrao.png");
            }
        }
        if($this->dao->updateProduto($produto)){
            $this->controller->redirect('/Admin/produtos/produtos.php?msg=ok');
        }else{
            $this->controller->redirect('/Admin/produtos/produtos.php?msg=error');
        }
    }

    /**
     * @param $post
     * @param $file
     */
    public function admin_store($post, $file){
        $produto = new Produto();
        $produto->setSubCategoria($this->cat_dao->getSubCategoria($post['sub_categoria_id']));
        $produto->setNome($post['nome']);
        $produto->setDescricao($post['descricao']);
        $produto->setPreco($post['preco']);
        $produto->setQuantidade($post['quant']);
        $produto->setStatus($post['status']);
        if($file['foto']['size'] > 0) {
            try {
                $produto->setFoto(time() . ".png");
                move_uploaded_file($file['foto']['tmp_name'], $produto->diretorio . $produto->getFoto());
            } catch (\Exception $e) {
                $produto->setFoto("produto-padrao.png");
            }
        }
        if($this->dao->insertProduto($produto)){
            $this->controller->redirect('/Admin/produtos/produtos.php?msg=ok');
        }else{
            $this->controller->redirect('/Admin/produtos/produtos.php?msg=error');
        }

    }
    public function admin_remove($post){
        if($this->dao->removeProduto($this->dao->getProduto($post['id']))){
            $this->controller->redirect('/Admin/produtos/produtos.php?msg=ok');
        }else{
            $this->controller->redirect('/Admin/produtos/produtos.php?msg=error');
        }
    }
}