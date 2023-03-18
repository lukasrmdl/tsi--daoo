<?php

use classes\Imc;
use classes\Paciente;

    include 'autoload.php';

    // Paciente
    $paciente1 = new Paciente('Eduardo', 21, 1.8, 80);

    // Imc paciente
    $imc = new Imc();
    $imc::calc($paciente1);
    $imc::mostrarImc($paciente1);

    // Calculo paciente
    $imc::classificarImc($paciente1);

?>