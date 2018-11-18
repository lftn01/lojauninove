<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 17/11/2018
 * Time: 19:12
 */

namespace DAO;


use Model\Admin;

class AdminDAO extends Banco
{
    private $table;
    private $orderBy;

    function __construct(){
        parent::__construct();
        $this->setTable("administradores");
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

    /**
     * @return array
     */
    public function getAdmins(){
        $query = "SELECT * FROM ".$this->getTable()." ".$this->getOrderBy();
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $email, $senha, $status);
        $admins = [];
        while ($stmt->fetch()){
            $admin = new Admin();
            $admin->setId($id);
            $admin->setNome($nome);
            $admin->setEmail($email);
            $admin->setSenha($senha);
            $admin->setStatus($status);
            $admins[] = $admin;
        }
        return $admins;
    }

    public function getAdmin($id){
        $query = "SELECT * FROM ".$this->getTable()." WHERE id = ".$id;
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $email, $status, $senha);
        while ($stmt->fetch()){
            $admin = new Admin();
            $admin->setId($id);
            $admin->setNome($nome);
            $admin->setEmail($email);
            $admin->setSenha($senha);
            $admin->setStatus($status);
        }
        return $admin;
    }

    public function getAdminLogin(Admin $admin){
        $query = "SELECT * FROM ".$this->getTable()." WHERE email = '".$admin->getEmail()."' AND senha = '".$admin->getSenha()."'";
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $email, $status, $senha);
        while ($stmt->fetch()){
            $admin = new Admin();
            $admin->setId($id);
            $admin->setNome($nome);
            $admin->setEmail($email);
            $admin->setSenha($senha);
            $admin->setStatus($status);
        }
        return $admin;
    }

    /**
     * @param Admin $admin
     * @return bool
     */
    public function insertAdmin(Admin $admin){
        try{
            $query = "INSERT INTO ".$this->getTable()." (nome, email, senha, status) VALUES ('".$admin->getNome()."', '".$admin->getEmail()."', '".$admin->getSenha()."', '".$admin->getStatus()."')";
            $stmt = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    /**
     * @param Admin $admin
     * @return bool
     */
    public function updateAdmin(Admin $admin){
        try{
            $query = "UPDATE ".$this->getTable(). " SET nome = '".$admin->getNome()."', email = '".$admin->getEmail()."', senha = '".$admin->getSenha()."', status = '".$admin->getStatus()."' WHERE id = ".$admin->getId();
            $stmt = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch(\Exception $e){
            return false;
        }
    }

    /**
     * @param Admin $admin
     * @return bool
     */
    public function removeAdmin(Admin $admin){
        try{
            $query = "DELETE FROM ".$this->getTable(). " WHERE id = ".$admin->getId();
            $stmt = $this->getConn()->prepare($query);
            $stmt->execute();
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
}