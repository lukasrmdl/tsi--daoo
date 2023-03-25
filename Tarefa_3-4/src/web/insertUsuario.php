<?php 

require_once '../../vendor/autoload.php';

use Daoo\Atividade03\models\Usuario;

if (
  !isset($_POST['nome']) ||
  !isset($_POST['sobrenome']) ||
  !isset($_POST['email']) ||
  !isset($_POST['senha']) 
) {
  die('Erro: falta de parametros !');
}

$usuario = new Usuario(
  $_POST['nome'],
  $_POST['sobrenome'],
  $_POST['email'],
  $_POST['senha']
);

if ($usuario->create()) {
  echo json_encode([
    "success"=>"Usuario criado com sucesso!", 
    "data"=>(array)$usuario
  ]);
} else {
  echo json_encode([
    "error"=>"Erro ao criar produto!"
  ]);
}
