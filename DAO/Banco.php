<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 13/11/2018
 * Time: 22:00
 */

namespace DAO;

use \mysqli;

class Banco
{
    private $conn;
    private $host;
    private $user;
    private $senha;
    private $banco;

    function __construct($host = "localhost", $user = "root", $senha = "q1w2e3r4", $banco = "lojauninove")
    {
        $this->host = $host;
        $this->user = $user;
        $this->senha = $senha;
        $this->banco = $banco;
        $this->conn = new mysqli($this->host, $this->user, $this->senha, $this->banco);
    }

    /**
     * @return \mysqli
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * @param \mysqli $conn
     */
    public function setConn($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return string
     */
    public function getBanco()
    {
        return $this->banco;
    }

    /**
     * @param string $banco
     */
    public function setBanco($banco)
    {
        $this->banco = $banco;
    }

    /**
     * @param $result
     * @return array
     */
    public function fetch_assoc($query){
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id,$nome);

        $resultado_final = [];
        while($stmt->fetch()){
            //$resultado_final[] = $data;
        }
        return $resultado_final;
    }
}