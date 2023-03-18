<?php

namespace tsi_daoo\Tarefa_3\controller\api;

use tsi_daoo\Tarefa_3\model\Desconto as DescontoModel;
use Exception;

class Desconto extends Controller
{

	public function __construct()
	{
		$this->setHeader();
		$this->model = new DescontoModel();
	}

	public function index()
	{
		echo json_encode($this->model->read());
	}

	public function show($id)
	{
		$desconto = $this->model->read($id);
		if ($desconto) {
			$response = ['desconto' => $desconto];
		} else {
			$response = ['Erro' => "desconto não encontrado"];
			header('HTTP/1.0 404 Not Found');
		}
		echo json_encode($response);
	}

	public function store()
	{
		try {
			$this->validateDescontoRequest();

			$this->model = new DescontoModel(
				$_POST['descricao'],
				$_POST['taxa']
			);

			if ($this->model->create())
				echo json_encode([
					"success" => "Desconto criado com sucesso!",
					"data" => $this->model->getColumns()
				]);
			else throw new \Exception("Erro ao criar desconto!");
		} catch (\Exception $error) {
			$this->setHeader(500,'Erro interno do servidor!!!!');
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
	}

	public function update()
	{
		try {
			if(!$this->validatePostRequest(['id']))
				throw new Exception("Informe a ID do Desconto!!");
			
			$this->validateDescontoRequest();

			$this->model = new DescontoModel(
				$_POST['descricao'],
				$_POST['taxa']
            );

			if ($this->model->update())
				echo json_encode([
					"success" => "Desconto atualizado com sucesso!",
					"data" => $this->model->getColumns()
				]);
			else throw new \Exception("Erro ao atualizar desconto!");
		} catch (\Exception $error) {
			$this->setHeader(500,'Erro interno do servidor!!!!');
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
	}

	public function remove()
	{
		try {
			if (!isset($_POST["id"])){
				$this->setHeader(400,'Bad Request.');
				throw new \Exception('Erro: id obrigatorio!');
			}
			$id = $_POST["id"];
			if ($this->model->delete($id)) {
				$response = ["message:" => "Desconto id:$id removido com sucesso!"];
			} else {
				$this->setHeader(500,'Internal Error.');
				throw new Exception("Erro ao remover Desconto!");
			}
			echo json_encode($response);
		} catch (\Exception $error) {
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
	}

	private function validateDescontoRequest()
	{
		$fields = [
			'descricao',
			'taxa'
		];
		if (!$this->validatePostRequest($fields))
			throw new \Exception('Erro: campos imcompletos!');
	}
}
