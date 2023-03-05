<?php

    namespace classes;

    class Paciente extends Pessoa{

        public function __construct($nome, $idade, $altura, $peso)
        {
            parent::__construct($nome, $idade, $altura, $peso);
        }

        public function setAltura(float $altura){
            $this->altura = $altura;
        }

        public function setPeso(float $peso){
            $this->peso = $peso;
        }

        public function __set($nome, $valor){
            if($nome == 'imc'){
                if(is_array($valor)){
                    if($valor[0] > $valor[1]){
                        $this->imc = $valor[0]/ pow($valor[1], 2);
                    }else{
                        echo "Erro, o primeiro item deve ser o peso.";
                    }
                }else{
                    echo "Erro ao atualizar imc, esperado um array [peso, altura]";
                }
            }else{
                $this->$nome = $valor;
            }
        }

    }

?>