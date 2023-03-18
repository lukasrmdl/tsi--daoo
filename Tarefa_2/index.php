<?php

include 'autoload.php';

use classes\Atleta;
use classes\Medico;
use logs\Relatorio;

$medico = new Medico("Sandra", 32, 4500, 4, 80, 1.75);
$atleta = new Atleta("Eduardo", 18, 65, 1.70);

$medico->mostrarsalario();
$medico->mostrarTempoContrato();

$relatorio = new Relatorio();

$relatorio->add($medico);
$relatorio->add($atleta);

$relatorio->imprime();

?>