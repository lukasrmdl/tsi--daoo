<?php

namespace tsi_daoo\Tarefa_3\model;

use Exception;
use PDO;

class ORM
{
    protected $conn;    //connection

    protected $table;   //tableName
    protected $primary; //primary Key
    protected $columns; //columnNames
    protected $params;  //:columnNames
    protected $updated; //set columnNames=:columnNames
    protected $values;  //array values
    protected $filters; //like
    private $delimiter; //Delmitadores de campo
    protected const FETCH = PDO::FETCH_ASSOC;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
        $this->resetMappers();
        $this->delimiter = '`';
        if(Connection::getDrive()=='pgsql')
            $this->delimiter = "\"";
    }

    private function resetMappers(){
        $this->filters = '1';
        $this->columns = '';
        $this->params = '';
        $this->updated = '';
        $this->values = [];
    }

    protected function mapColumns(iDAO $daoInterface)
    {
        if(count($this->values))
            $this->resetMappers();

        if (isset($daoInterface)) {
            foreach ($daoInterface->getColumns() as $key => $value) {
                $this->params .= " :$key,";
                $this->columns .= " $key,";
                $this->values[":$key"] = is_bool($value) ? (int)$value : $value;
                $this->updated .= $this->delimite($key)." = :$key,";//POSTGRE
            }
            $this->params = substr($this->params, 0, strlen($this->params) - 1);
            $this->columns = substr($this->columns, 0, strlen($this->columns) - 1);
            $this->updated = substr($this->updated, 0, strlen($this->updated) - 1);
        }
    }

    protected function setFilters($arrayFilter)
    {
        $this->values=[];
       
        foreach ($arrayFilter as $key => $value){
            $this->filters=$this->delimite($key)." ilike :$key";
            $this->values[":$key"] = "%$value%";
            break;
        }
        
        array_shift($arrayFilter);
        foreach ($arrayFilter as $key => $value) {
            $this->filters .= " AND ".$this->delimite($key)." ilike :$key";
            $this->values[":$key"] = "%$value%";
        }
    }

    protected function select(array $columns=[])
    {
        $selectedColumns = '';
        foreach($columns as $column)
            $selectedColumns .=", $column";

        if(!$columns)
            $selectedColumns = "*";
        
        $sql = "SELECT $selectedColumns FROM $this->table";
        $prepStmt = $this->conn->prepare($sql);

        if ($prepStmt->execute()) {
            $this->dumpQuery($prepStmt);
            return $prepStmt->fetchAll(self::FETCH);
        }else{
            throw new Exception("Erro no select!");
        }
    }

    protected function selectById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->primary = :id";
        $prepStmt = $this->conn->prepare($sql);
        $prepStmt->bindValue(':id', $id);

        if ($prepStmt->execute()) {
            $this->dumpQuery($prepStmt);
            return $prepStmt->fetchAll(self::FETCH);
        }else{
            throw new Exception("Erro no select!");
        }
    }

    protected function executeTransaction($sqlCommands, $parameters, $useLastId = false)
    {
        try {
            $this->conn->beginTransaction();
            //implementar   
        } catch (\PDOException $error) {
            var_dump([$error->getMessage(), $error->getTraceAsString()]);
            $this->conn->rollBack();
            unset($this->conn);
            return false;
        }
    }

    protected function dumpQuery($prepStatement)
    {
        ob_start();
        $prepStatement->debugDumpParams();
        error_log(ob_get_contents());
        ob_end_clean();
    }

    protected function lastId(){
        if(Connection::getDrive()=='pgsql'){
            $sequenceName = $this->table."_".$this->primary."_seq";
            return $this->conn->lastInsertId($sequenceName);
        }
        return $this->conn->lastInsertId();
    }

    private function delimite($field){
        return $this->delimiter.$field.$this->delimiter;
    }
}
