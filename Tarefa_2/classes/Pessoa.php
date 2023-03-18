<?php

    namespace classes;

    class Pessoa{
        public $nome, $idade;

        public function __construct($nome, $idade)
        {
            $this->nome = $nome;
            $this->idade = $idade;
        }

        public function __destruct()
        {
            echo "\n$this->nome foi destruido!\n";
        }

        public function __get($nome){
            return $this->nome;
        }

        public function __toString()
        {
            $class = self::class;
            return "\n===DADOS DE $class==="
                . "\nNome: $this->nome"
                . ($this->idade ? "\n Idade: $this->idade" : "\n");
        }

    }

?>