<?php

require_once '../../vendor/autoload.php';

use Daoo\Atividade03\models\Usuario;

if (!isset($_POST['id']) || !sizeof($_POST) > 1) {
  die('Erro: falta de parametros !');
}

$usuario = new Usuario(
  $_POST['nome'],
  $_POST['sobrenome'],
  $_POST['email'],
  $_POST['senha']
);

$usuario->id = $_POST['id'];

if ($usuario->update()) {
  echo json_encode([
    'sucesso' => "Usuário Atualizado!",
    'usuário' => $produto->mapColumns()
  ]);
} else {
  echo json_encode([
    'Error' => "Erro ao atualizar usuário!"
  ]);
}