<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 13/11/2018
 * Time: 21:52
 */

namespace Model;

use Model\Usuario;

class Pedido
{
    private $id;
    private $usuario;
    private $preco_frete;
    private $status;
    private $data_cadastro;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario_id
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getPrecoFrete($format=null)
    {
        if(empty($format))
            return $this->preco_frete;
        else
            return "R$&nbsp;".number_format($this->preco_frete, 2, ",", ".");
    }

    /**
     * @param mixed $preco_frete
     */
    public function setPrecoFrete($preco_frete)
    {
        $this->preco_frete = $preco_frete;
    }

    /**
     * @return mixed
     */
    public function getStatus($format=null)
    {
        if(empty($format))
            return $this->status;
        else{
            switch ($this->status){
                case "P":
                    return "Pago";
                    break;
                case "R":
                    return "Recusado";
                    break;
                default:
                    return "Aberto";
                    break;
            }
        }
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getDataCadastro($format=null)
    {
        if(empty($format))
            return $this->data_cadastro;
        else{
            $data = new \DateTime($this->data_cadastro);
            return $data->format($format);
        }
    }

    /**
     * @param mixed $data_cadastro
     */
    public function setDataCadastro($data_cadastro)
    {
        $this->data_cadastro = $data_cadastro;
    }

}