<?php

namespace tsi_daoo\Tarefa_3\model;

use Exception;

class Desconto extends ORM implements iDAO
{
    private $id, $descricao, $taxa;

    public function __construct($descricao = '', float $taxa = 0)
    {
        parent::__construct();
        $this->table = 'descontos';
        $this->descricao = $descricao;
        $this->taxa = $taxa;
        $this->mapColumns($this);
    }

    public function read($id = null)
    {
        try {
            if ($id) {
                return $this->selectById($id);
            }
            return $this->select([]);
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            throw new Exception($error->getMessage());
        }
    }

    public function create()
    {
        $sql = "INSERT INTO $this->table ($this->columns) VALUES ($this->params)";
        $preparedStatement = $this->conn->prepare($sql);
        $result = $preparedStatement->execute($this->values);
        return ($result && $preparedStatement->rowCount() == 1);
    }

    public function update()
    {
        $this->values[':id'] = $this->id;
        $sql = "UPDATE $this->table SET $this->updated WHERE id_desc = :id";
        $preparedStatement = $this->conn->prepare($sql);
        if ($preparedStatement->execute($this->values))
            return $preparedStatement->rowCount() > 0;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id_desc = :id";
        $preparedStatment = $this->conn->prepare($sql);
        return $preparedStatment->execute([':id' => $id]);
    }

    public function show($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id_desc = :id";
        $preparedStatement = $this->conn->prepare($sql);
        if ($preparedStatement->execute([':id' => $id]))
            return $preparedStatement->fetchAll(\PDO::FETCH_ASSOC);
        return false;
    }

    public function filter($arrayFilter)
    {
        try {
            if (!sizeof($arrayFilter)) 
                throw new \Exception("Filtros vazios!");
            $this->setFilters($arrayFilter);
            $sql = "SELECT * FROM descontos WHERE $this->filters";
            $preparedStatement = $this->conn->prepare($sql);
            if ($preparedStatement->execute($this->values))
                return $preparedStatement->fetchAll(\PDO::FETCH_ASSOC);
            return false;
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            if(isset($preparedStatement))
                $this->dumpQuery($preparedStatement);
            throw new \Exception($error->getMessage());
        }
    }

    public function getDescFromProd($id_prod)
    {
        $sql = "SELECT * FROM $this->table INNER JOIN prod_desc
                ON descontos.id_desc = prod_desc.id_desc WHERE prod_desc.id_prod = :id; ";
        $preparedStatement = $this->conn->prepare($sql);
        if ($preparedStatement->execute([':id' => $id_prod]))
            return $preparedStatement->fetchAll(\PDO::FETCH_ASSOC);
        return false;
    }

    public function createMany($descontos)
    {
        foreach ($descontos as $desc) {
            $sqls[] = "INSERT INTO descontos ($this->columns) VALUES ($this->params)";
            $params[] = [':descricao' => $desc[0], ':taxa' => $desc[1]];
        }
        return $this->executeTransaction($sqls, $params);
    }

    public function getColumns(): array
    {
        return [
            "descricao" => $this->descricao,
            "taxa" => $this->taxa
        ];
    }
}
