<?php

namespace tsi_daoo\Tarefa_3\controller\api;

use tsi_daoo\Tarefa_3\model\Usuario as UsuarioModel;
use Exception;

class Usuario extends Controller
{

	public function __construct()
	{
		$this->setHeader();
		$this->model = new UsuarioModel();
	}

	public function index()
	{
		echo json_encode($this->model->read());
	}

	public function show($id_user)
	{
		$usuario = $this->model->read($id_user);
		if ($usuario) {
			$response = ['usuario' => $usuario];
		} else {
			$response = ['Erro' => "Usuario não encontrado"];
			header('HTTP/1.0 404 Not Found');
		}
		echo json_encode($response);
	}

	public function store()
	{
		try {
			$this->validateUsuarioRequest();

			$this->model = new UsuarioModel(
				$_POST['nome'],
				$_POST['email'],
				$_POST['senha']
			);


			if ($this->model->create())
				echo json_encode([
					"success" => "Usario criado com sucesso!",
					"data" => $this->model->getColumns()
				]);
			else throw new \Exception("Erro ao criar usuario!");
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
				throw new Exception("Informe o ID do Uusario!!");
			
			$this->validateUsuarioRequest();

			$this->model = new UsuarioModel(
				$_POST['nome'],
				$_POST['email'],
				$_POST['senha']
			);
			$this->model->id_user = $_POST["id_user"];


			if ($this->model->update())
				echo json_encode([
					"success" => "Uusario atualizado com sucesso!",
					"data" => $this->model->getColumns()
				]);
			else throw new \Exception("Erro ao atualizar usuario!");
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
			if (!isset($_POST["id_user"])){
				$this->setHeader(400,'Bad Request.');
				throw new \Exception('Erro: id obrigatorio!');
			}
			$id_user = $_POST["id_user"];
			if ($this->model->delete($id_user)) {
				$response = ["message:" => "Usuario id_user:$id_user removido com sucesso!"];
			} else {
				$this->setHeader(500,'Internal Error.');
				throw new Exception("Erro ao remover Usario!");
			}
			echo json_encode($response);
		} catch (\Exception $error) {
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
	}

	private function validateUsuarioRequest()
	{
		$fields = [
			'nome',
			'email',
			'senha'
		];
		if (!$this->validatePostRequest($fields))
			throw new \Exception('Erro: campos imcompletos!');
	}
}
