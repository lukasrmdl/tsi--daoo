<?php 

require_once '../../vendor/autoload.php';

use Daoo\Atividade03\models\Usuario;

header("Content-Type:application/json");

$usuarioDao = new Usuario();

if (!isset($_GET)  || !sizeof($_GET)) {
  die("Filtros vazios!");
} else {
  echo json_encode($usuarioDao->filter($_GET));
}
