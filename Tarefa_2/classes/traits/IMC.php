<?php

    namespace classes\traits;

    trait IMC{
        public $imc;

        public function calcImc(){
            if($this->peso && $this->altura){
                $this->imc = $this->peso / pow($this->altura, 2);
            }else{
                echo 'Erro, informe o peso e a altura primeiro!';
            }
        }
        public function mostrarImc(){
            echo "\nO IMC de $this->nome é: " . $this->imc
                . "\nA classificação de saúde é: " . $this->classificarSaude()
                . "\nA condição de saúde é: " . $this->classificaCond($this->idade, $this->imc)
                . "\n";
        }

        public function classificarSaude(){
            if($this->imc < 18.5){
                return "Abaixo do peso";
            }
            else if($this->imc >= 18.5 && $this->imc <= 24.9){
                return "Saudável";
            }
            else if($this->imc >= 25 && $this->imc <= 29.0){
                return "Sobrepeso";
            }
            else {
                return "Obesidade";
            }
        }

        public function cond($idade, $imc){
            $ranges = array(
                array("min_idade" => 19, "max_idade" => 24, "min_imc" => 19, "max_imc" => 24),
                array("min_idade" => 19, "max_idade" => 24, "min_imc" => 19, "max_imc" => 24),
                array("min_idade" => 19, "max_idade" => 24, "min_imc" => 19, "max_imc" => 24),
                array("min_idade" => 19, "max_idade" => 24, "min_imc" => 19, "max_imc" => 24),
                array("min_idade" => 19, "max_idade" => 24, "min_imc" => 19, "max_imc" => 24),
                array("min_idade" => 19, "max_idade" => 24, "min_imc" => 19, "max_imc" => 24)
            );

            foreach ($ranges as $range){
                if($idade >= $range["min_idade"] && $idade <= $range["max_idade"]
                    && $imc >= $range["min_imc"] && $imc <= $range["max_imc"]
                ){
                    return true;
                }
            }

            return false;

        }

        public function classificaCond($idade, $imc){
            if($this->cond($idade, $imc)){
                return "Condição está ok";
            }else{
                return "Condição está anormal";
            }
        }

    }
    ?>