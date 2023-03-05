<?php

    namespace classes;

    use classes\Paciente;

    class Imc{
        private $imc;

        public static function calc(Paciente $paciente){
            $imc = $paciente->peso / pow($paciente->altura, 2);
            return $imc;
        }

        public static function mostrarImc(Paciente $paciente){
            $imc = Imc::calc($paciente);
            echo "\nO IMC de $paciente->nome é: ". number_format($imc, 2) . "\n";
        }

        public static function classificarImc(Paciente $paciente){
            $imc = Imc::calc($paciente);
            if($imc < 18.5){
                echo "\nO paciente $paciente->nome está abaixo do peso \n";
            }
            if($imc >= 18.5 && $imc <= 24.9){
                echo "\nO paciente $paciente->nome está saudável \n";
            }
            if($imc >= 25 && $imc <= 29.0){
                echo "\nO paciente $paciente->nome está com Sobrepeso \n";
            }
            if($imc >= 30){
                echo "\nO paciente $paciente->nome está com Obesidade \n";
            }
        }

    }

?>