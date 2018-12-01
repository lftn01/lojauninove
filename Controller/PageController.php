<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 20/11/2018
 * Time: 21:06
 */

namespace Controller;

use DAO\CarrinhoDAO;
use DAO\CategoriaDAO;
use DAO\PedidoDAO;
use DAO\PedidoItemDAO;
use DAO\ProdutoDAO;
use DAO\SubCategoriaDAO;
use DAO\UsuarioDAO;
use Model\Carrinho;
use Model\Pedido;
use Model\PedidoItem;
use Model\Usuario;

class PageController
{
    private $dao;
    private $controller;

    function __construct()
    {
        require_once "../autoload.php";
        $this->dao = new CategoriaDAO();
        $this->usu_dao = new UsuarioDAO();
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
     * @return array
     */
    public function home(){
        return [
            "produtos" => $this->pro_dao->getProdutos(1)
        ];
    }

    public function login($post){
        $usuario = new Usuario();
        $usuario->setEmail($post['email']);
        $usuario->setSenha($post['senha']);
        $this->usu_dao->getUsuarioLogin($usuario);
        if(!empty($usuario->getId())){
            $_SESSION['usuario'] = $usuario->getId();
            $this->controller->redirect('/Paginas/home.php');
        }else{
            $this->controller->redirect('/Paginas/login.php?error=1');
        }
    }

    /**
     * @param $post
     */
    public function cadastrar($post){
        $usuario = new Usuario();
        $usuario->setNome($post['nome']);
        $usuario->setEmail($post['email']);
        $usuario->setSenha($post['senha']);
        $usuario->setCpf($post['cpf']);
        $usuario->setCep($post['cep']);
        $usuario->setLogradouro($post['logradouro']);
        $usuario->setEstado($post['estado']);
        $usuario->setCidade($post['cidade']);
        $usuario->setNumero($post['numero']);
        if($id_usuario = $this->usu_dao->insertUsuario($usuario)){
            $_SESSION['usuario'] = $id_usuario;
        }
        $this->controller->redirect('/Paginas/home.php');
    }

    /**
     * @param $categoria_id
     * @return array
     */
    public function categorias($categoria_id){
        return $this->sub_cat_dao->getSubCategoriasByCategoria($categoria_id);
    }

    /**
     * @param $sub_categoria_id
     * @return array
     */
    public function categorias_detalhes($sub_categoria_id){
        return $this->pro_dao->getProdutosByCategoria($sub_categoria_id);
    }

    /**
     * @return \Model\Produto
     */
    public function produto(){
        return $this->pro_dao->getProduto($_GET['id_produto']);
    }

    /**
     * @param $id_produto
     */
    public function carrinho($id_produto = null, $id_carrinho = null){
        $this->usu_dao->getUsuarioLogado();
        $car_dao = new CarrinhoDAO();
        $carrinhos = $car_dao->getCarrinhos($this->usu_dao->getUsuario($_SESSION['usuario']));
        if($id_produto && empty($id_carrinho)){
            if(sizeof($carrinhos) > 0){
                foreach ($carrinhos as $c){
                    if($c->getProduto()->getId() == $id_produto){
                        $c->setQuantidade($c->getQuantidade() + 1);
                        $car_dao->updateCarrinho($c);
                        unset($id_produto);
                    }
                }
                if(!empty($id_produto)){
                    $carrinho = new Carrinho();
                    $carrinho->setUsuario($this->usu_dao->getUsuario($_SESSION['usuario']));
                    $carrinho->setProduto($this->pro_dao->getProduto($_GET['id_produto']));
                    $carrinho->setQuantidade(1);
                    if($car_dao->insertCarrinho($carrinho)){
                        $this->controller->redirect("/Paginas/carrinho.php");
                    }
                }else{
                    $this->controller->redirect("/Paginas/carrinho.php");
                }
            }else{
                $carrinho = new Carrinho();
                $carrinho->setUsuario($this->usu_dao->getUsuario($_SESSION['usuario']));
                $carrinho->setProduto($this->pro_dao->getProduto($_GET['id_produto']));
                $carrinho->setQuantidade(1);
                if($car_dao->insertCarrinho($carrinho)){
                    $this->controller->redirect("/Paginas/carrinho.php");
                }
            }
        }elseif(!empty($id_carrinho)){
            $carrinho = $car_dao->getCarrinhosById($id_carrinho);
            $carrinho->setQuantidade($carrinho->getQuantidade() - 1);
            $car_dao->updateCarrinho($carrinho);
            $this->controller->redirect("/Paginas/carrinho.php");
        }else{
            return [
                'carrinhos' => $carrinhos,
                'total' => $car_dao->getTotal(1)
            ];
        }
    }

    public function remover_carrinho($id){
        $car_dao = new CarrinhoDAO();
        $car_dao->removerCarrinho($car_dao->getCarrinhosById($id));
        $this->controller->redirect("/Paginas/carrinho.php");
    }

    public function checkout(){
        $usuario = $this->usu_dao->getUsuario($_SESSION['usuario']);
        $car_dao = new CarrinhoDAO();
        $ped_dao = new PedidoDAO();
        $pedit_dao = new PedidoItemDAO();
        $carrinhos = $car_dao->getCarrinhos($usuario);
        $pedido = new Pedido();
        $pedido->setUsuario($usuario);
        $pedido->setPrecoFrete(10);
        if ($ped_dao->insertPedido($pedido)) {
            foreach ($carrinhos as $c) {
                $item = new PedidoItem();
                $item->setProduto($c->getProduto());
                $item->setPedido($pedido);
                $item->setPreco($c->getProduto()->getPreco());
                $item->setQuantidade($c->getQuantidade());
                $pedit_dao->insertItem($item);
                $car_dao->removerCarrinho($c);
            }
            $this->controller->redirect("/Paginas/pedidos.php?id_pedido=" . $pedido->getId());
        } else {
            $this->controller->redirect("/Paginas/carrinho.php?error=1");
        }
    }

    /**
     * @return array
     */
    public function pedidos(){
        $this->usu_dao->getUsuarioLogado();
        $ped_dao = new PedidoDAO();
        $usuario = $this->usu_dao->getUsuario($_SESSION['usuario']);
        return [
            'pedidos' => $ped_dao->getPedidosByUsuario($usuario)
        ];
    }

    public function pedidos_detalhe($id){
        $this->usu_dao->getUsuarioLogado();
        $ped_dao = new PedidoDAO();
        return $ped_dao->getPedidosById($id);
    }
}
