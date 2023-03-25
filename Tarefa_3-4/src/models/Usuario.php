<?php 

namespace Daoo\Atividade03\models;

use PDO;
use Exception;

class Usuario extends ORM implements iDAO {
  private 
    $id,
    $nome,
    $sobrenome,
    $email,
    $senha,
    $estatus,
    $imagem,
    $adm,
    $mediaAvaliacoes,
    $avaliacoesRecebidas;

  public function __construct(
    $nome = '',
    $sobrenome = '',
    $email = '',
    $senha = '',
    $estatus = false,
    $imagem = '',
    $adm = false,
    $mediaAvaliacoes = 0,
    $avaliacoesRecebidas = 0
  ) {
    parent::__construct();
    $this->table = 'usuarios';
    $this->primary = 'id_usuario';
    $this->nome = $nome;
    $this->sobrenome = $sobrenome;
    $this->email = $email;
    $this->senha = $senha;
    $this->estatus = $estatus;
    $this->imagem = $imagem;
    $this->adm = $adm;
    $this->mediaAvaliacoes = $mediaAvaliacoes;
    $this->avaliacoesRecebidas = $avaliacoesRecebidas;
    $this->mapColumns($this);
  }

  public function read($id = null) {
    try {
      if ($id) {
        return $this->selectById($id);
      } 
      return $this->select([]);
    } catch (Exception $error) {
      error_log("Usuario, read: " . print_r($error, true));
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
      error_log("Usuario, create: " . print_r($error, true));
      if (isset($prepStmt)) {
        $this->dumpQuery($prepStmt);
      }
      return false;
    }
  }

  public function update() {
    try {
      $this->values[':id'] = $this->id;
      $sql = "UPDATE $this->table SET $this->updated  WHERE id_usuario = :id";
      $prepStmt = $this->conn->prepare($sql);
      if ($prepStmt->execute($this->values)) {
        $this->dumpQuery($prepStmt);
        return $prepStmt->rowCount() > 0;
      }
    } catch (Exception $error) {
      error_log("Usuario, update: " . print_r($error, true));
      return false;
    }
  }

  public function delete($id) {
    try {
      $sql = "DELETE FROM $this->table WHERE id_usuario = :id";
      $prepStmt = $this->conn->prepare($sql);
      if ($prepStmt->execute([':id' => $id])) {
        return $prepStmt->rowCount() > 0;
      }
    } catch (Exception $error) {
      error_log("Usuario, delete: " . print_r($error, true));
      return false;
    }
  }

  public function getColumns(): array {
    return [
      "nome" => $this->nome,
      "sobrenome" => $this->sobrenome,
      "email" => $this->email,
      "senha" => $this->senha,
      "estatus" => $this->estatus,
      "imagem" => $this->imagem,
      "adm" => $this->adm,
      "media_avaliacoes" => $this->mediaAvaliacoes,
      "avaliacoes_recebidas" => $this->avaliacoesRecebidas,
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
