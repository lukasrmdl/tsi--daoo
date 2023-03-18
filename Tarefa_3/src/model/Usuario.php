<?php

namespace tsi_daoo\Tarefa_3\model;

use Exception;

class Usuario extends ORM implements iDAO
{
    private $id_user, $nome, $email, $senha;

    public function __construct(
        $nome = '',
        $email = '',
        $senha = ''
    ) {
        parent::__construct();

        $this->table = 'usuarios';
        $this->primary = 'id_user';
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->mapColumns($this);
    }

    public function read($id_user = null)
    {
        try {
            if ($id_user) {
                return $this->selectById($id_user);
            }
            return $this->select([]);
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            throw new Exception($error->getMessage());
        }
    }

    public function create()
    {
        try {
            $sql = "INSERT INTO $this->table ($this->columns) "
                . "VALUES ($this->params)";

            $prepStmt = $this->conn->prepare($sql);
            $result = $prepStmt->execute($this->values);
            
            if(!$result || $prepStmt->rowCount() != 1)
                throw new Exception("Erro ao inserir produto!!");

            $this->id_user = $this->conn->lastInsertId();
            $this->dumpQuery($prepStmt);
            return true;
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            $prepStmt ?? $this->dumpQuery($prepStmt);
            return false;
        }
    }

    public function update()
    {
        try {
            $this->values[':id_user'] = $this->id_user;
            $sql = "UPDATE $this->table SET $this->updated  WHERE id_user = :id_user";
            $prepStmt = $this->conn->prepare($sql);
            if ($prepStmt->execute($this->values)) {
                $this->dumpQuery($prepStmt);
                return $prepStmt->rowCount() > 0;
            }
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            $this->dumpQuery($prepStmt);
            return false;
        }
    }

    public function delete($id_user)
    {
        $sql = "DELETE FROM $this->table WHERE id_user = :id_user";
        $prepStmt = $this->conn->prepare($sql);
        if ($prepStmt->execute([':id_user' => $id_user]))
            return $prepStmt->rowCount() > 0;
        else return false;
    }

    public function filter($arrayFilter)
    {
        try {
            if (!sizeof($arrayFilter))
                throw new \Exception("Filtros vazios!");
            $this->setFilters($arrayFilter);
            $sql = "SELECT * FROM usuarios WHERE $this->filters";
            $prepStmt = $this->conn->prepare($sql);
            if (!$prepStmt->execute($this->values))
                return false;
            $this->dumpQuery($prepStmt);
            return $prepStmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            if(isset($prepStmt))
                $this->dumpQuery($prepStmt);
            throw new \Exception($error->getMessage());
        }
    }

    public function getColumns(): array
    {
        $columns = [
            "nome" => $this->nome,
            "email" => $this->email,
            "senha" => $this->senha
        ];
        if($this->id_user) $columns['id_user']=$this->id_user;
        return $columns;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
        if ($name != 'id_user') $this->mapColumns($this);
    }

    public function __get($name)
    {
        return $this->$name;
    }

}
