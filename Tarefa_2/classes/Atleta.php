<?php

    namespace classes;


    class Atleta extends Pessoa{
        
        use traits\IMC;

        private $peso, $altura;

        public function __construct($nome, $peso, $altura, $idade = null)
        {
            $this->nome = $nome;
            $this->peso = $peso;
            $this->altura = $altura;
            $this->idade = $idade;
            $this->calcImc();
        }

        public function __toString()
        {
            $class = self::class;
            return "\n===DADOS DE $class==="
                . "\nNome: $this->nome"
                . ($this->idade ? "\n Idade: $this->idade" : "")
                . "\nPeso: $this->peso"
                . "\nAltura: $this->altura"
                . "\nIMC: " . number_format($this->imc, 2)
                . "\nSaúde: " . $this->classificarSaude()
                . "\nCondição: " . $this->classificaCondicao($this->idade, $this->imc) . "\n";
        }

    }

?>