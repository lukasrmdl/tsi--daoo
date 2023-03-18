<?php 

namespace logs;

use \classes\iFuncionario;
use \classes\Pessoa;

class Relatorio {

	private $listaPessoas = [];

	public function add(Pessoa $pessoa){
		$this->listaPessoas[]=$pessoa;
	}
	
	public function log(Pessoa $pessoa){
    if ($pessoa instanceof iFuncionario){
      echo "\nlog: ".$pessoa;
    }
	}

	public function imprime(){
		echo "\n### RELATORIO ###\n";
		foreach ($this->listaPessoas as $pessoa) {
			$this->log($pessoa);
    }
		echo "\n#############\n";
	}
}