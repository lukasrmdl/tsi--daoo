<?php 

namespace Daoo\Atividade03\models;

use PDO;
use Exception;

class Produto extends ORM implements iDAO {
  private 
    $id,
    $modelo,
    $marca,
    $categoria,
    $informacoes,
    $preco,
    $idUsuario;

  public function __construct(
    $modelo = '',
    $marca = '',
    $categoria = '',
    $informacoes = '',
    $preco = false
  ) {
    parent::__construct();
    $this->table = 'produtos';
    $this->primary = 'id_produto';
    $this->modelo = $modelo;
    $this->marca = $marca;
    $this->categoria = $categoria;
    $this->informacoes = $informacoes;
    $this->preco = $preco;
    $this->idUsuario = 1;
    $this->mapColumns($this);
  }

  public function read($id = null) {
    try {
      if ($id) {
        return $this->selectById($id);
      } 
      return $this->select([]);
    } catch (Exception $error) {
      error_log("Produto, read: " . print_r($error, true));
      throw new Exception($error->getMessage());
    }
  }

  public function create() {
    try {
      $sql = "INSERT INTO $this->table ($this->columns) " . "VALUES ($this->params)";
      $prepStmt = $this->conn->prepare($sql);
      $result = $prepStmt->execute($this->values);
      $this->dumpQuery($prepStmt);
      return ($result && $prepStmt->rowCount() == 1);
    } catch (Exception $error) {
      error_log("Produto, create: " . print_r($error, true));
      if (isset($prepStmt)) {
        $this->dumpQuery($prepStmt);
      }
      return false;
    }
  }

  public function update() {
    try {
      $this->values[':id'] = $this->id;
      $sql = "UPDATE $this->table SET $this->updated  WHERE id_produto = :id";
      $prepStmt = $this->conn->prepare($sql);
      if ($prepStmt->execute($this->values)) {
        $this->dumpQuery($prepStmt);
        return $prepStmt->rowCount() > 0;
      }
    } catch (Exception $error) {
      error_log("Produto, update: " . print_r($error, true));
      return false;
    }
  }

  public function delete($id) {
    try {
      $sql = "DELETE FROM $this->table WHERE id_produto = :id";
      $prepStmt = $this->conn->prepare($sql);
      if ($prepStmt->execute([':id' => $id])) {
        return $prepStmt->rowCount() > 0;
      }
    } catch (Exception $error) {
      error_log("Produto, delete: " . print_r($error, true));
      return false;
    }
  }

  public function getColumns(): array {
    return [
      "modelo" => $this->modelo,
      "marca" => $this->marca,
      "categoria" => $this->categoria,
      "informacoes" => $this->informacoes,
      "preco" => $this->preco,
    ];
  }

  public function __set($name, $value) {
    $this->$name = $value;
    if ($name != 'id') $this->mapColumns($this);
  }

  public function __get($name) {
    return $this->$name;
  }
}
