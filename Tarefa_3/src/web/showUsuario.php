<?php

require_once '../../vendor/autoload.php';

use Daoo\Atividade03\models\Usuario;

header("Content-Type:application/json;charset=utf-8'");

$usuarioDao = new Usuario();

if (isset($_get['id'])) {
  $usuario = $usuarioDao->read($_GET['id']);
  if ($usuario) {
    $json =['produto'=>$produto];
  } else {
    $json = ['Erro'=>"Produto não encontrado"];
  }
  echo json_encode($json);
} else {
  echo json_encode($prodDao->read());
}
