<?php 

require_once '../vendor/autoload.php';

use Daoo\Atividade03\models\Usuario;

header("Content-Type:application/json");

if(!isset($_POST['id'])) {
  die('Erro: falta de parametros !');
}

$usuarioDao = new Usuario();

if ($usuarioDao->delete($_POST['id'])) {
  echo json_encode([
    'sucesso'=>"Usuario $_POST[id] Removido!"
  ]);
} else {
  echo json_encode([
    'Error'=>"Erro ao remover produto!"
  ]);
}
    