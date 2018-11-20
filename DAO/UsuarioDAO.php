<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 20/11/2018
 * Time: 20:08
 */

namespace DAO;


use Model\Usuario;

class UsuarioDAO extends Banco
{
    private $table;
    private $orderBy;

    function __construct(){
        parent::__construct();
        $this->setTable("usuarios");
        $this->setOrderBy("ORDER BY id ASC");
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @param mixed $orderBy
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
    }

    public function getUsuarios(){
        $query = "SELECT * FROM ".$this->getTable()." ".$this->getOrderBy();
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $email, $cpf, $senha, $cep, $logradouro, $bairro, $estado, $cidade, $numero, $status);
        $usuarios = [];
        while($stmt->fetch()){
            $usuario = new Usuario();
            $usuario->setId($id);
            $usuario->setNome($nome);
            $usuario->setEmail($email);
            $usuario->setCpf($cpf);
            $usuario->setCep($cep);
            $usuario->setLogradouro($logradouro);
            $usuario->setBairro($bairro);
            $usuario->setEstado($estado);
            $usuario->setCidade($cidade);
            $usuario->setNumero($numero);
            $usuario->setStatus($status);
            $usuarios[] = $usuario;
        }
        return $usuarios;
    }

    public function getUsuario($id){
        $query = "SELECT * FROM ".$this->getTable()." WHERE id = ".$id;
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $email, $cpf, $senha, $cep, $logradouro, $bairro, $estado, $cidade, $numero, $status);
        while($stmt->fetch()){
            $usuario = new Usuario();
            $usuario->setId($id);
            $usuario->setNome($nome);
            $usuario->setEmail($email);
            $usuario->setCpf($cpf);
            $usuario->setCep($cep);
            $usuario->setLogradouro($logradouro);
            $usuario->setBairro($bairro);
            $usuario->setEstado($estado);
            $usuario->setCidade($cidade);
            $usuario->setNumero($numero);
            $usuario->setStatus($status);
        }
        return $usuario;
    }
}