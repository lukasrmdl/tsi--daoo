<?php

namespace classes;


class Medico extends Pessoa implements iFuncionario {
    protected $salario;
    protected $tempoContrato;

  public function __construct($nome, $idade, $salario, $tempoContrato, $peso=null, $altura=null) {
    parent::__construct($nome, $idade, $peso, $altura);
    $this->salario = $salario;
    $this->tempoContrato = $tempoContrato;
  }

  public function mostrarsalario(){
    echo $this->nome . ": salário: R$ " . number_format($this->salario, 2, ",", ".") . ".\n";
  }

  public function mostrarTempoContrato(){
    echo $this->nome . ": contrato de " . $this->tempoContrato . " anos.\n";
  }

  public function __toString(){
		$className = self::class;
		return 	"\n===Dados de $className ==="
			. "\nNome: $this->nome"
			. ($this->idade ? "\nIdade: $this->idade" : "")
			. "\nPeso: $this->peso"
			. "\nAltura: $this->altura"
            . "\nSalário: $this->salario"
			. "\nTempo de contrato: " . $this->tempoContrato . "\n";
	}
}
?>