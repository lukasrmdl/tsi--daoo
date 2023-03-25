<?php 

namespace Daoo\Atividade03\controllers\api;

use Daoo\Atividade03\models\Usuario as UsuarioModel;
use Exception;

class Usuario extends Controller {
  public function __construct() {
    $this->setHeader();
    $this->model = new UsuarioModel();
  }

  public function index() {
    echo json_encode($this->model->read());
  }

  public function show($id) {
    $usuario = $this->model->read($id);
    if ($usuario) {
      $response = ['usuario' => $usuario];
    } else {
      $response = ['Erro' => 'Usuário não encontrado!'];
      header('HTTP/1.0 404 Not Found');
    }
    echo json_encode($response);
  }

  public function store() {
    try {
      $this->validateUsuarioRequest();
      $this->model = new UsuarioModel(
				$_POST['nome'],
				$_POST['sobrenome'],
				$_POST['email'],
				$_POST['senha']
			);
      if ($this->model->create()) {
        echo json_encode([
          "success" => "Usuário criado com sucesso!",
					"data" => $this->model->getColumns()
        ]);
      } else {
        throw new Exception("Erro ao criar usuario!");
      }
    } catch (Exception $error) {
			$this->setHeader(500,'Erro interno do servidor!!!!');
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
  }

  public function update() {
    try {
      if (!$this->validatePostRequest(['id'])) {
        throw new Exception("Informe o ID do Usuário!!");
      }
      $this->validateUsuarioRequest();
      $this->model = new UsuarioModel(
				$_POST['nome'],
				$_POST['sobrenome'],
				$_POST['email'],
				$_POST['senha']
			);
      $this->model->id = $_POST["id"];
      if ($this->model->update()) {
        echo json_encode([
          "success" => "Usuário atualizado com sucesso!",
					"data" => $this->model->getColumns()
        ]);
      } else {
        throw new Exception("Erro ao atualizar usuario!");
      }
    } catch (Exception $error) {
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
  }

  public function remove() {
    try {
      if (!isset($_post['id'])) {
        $this->setHeader(400,'Bad Request.');
				throw new Exception('Erro: id obrigatorio!');
      }
      $id = $_POST["id"];
      if ($this->model->delete($id)) {
				$response = ["message:" => "Usuároip id:$id removido com sucesso!"];
			} else {
				$this->setHeader(500,'Internal Error.');
				throw new Exception("Erro ao remover Usuário!");
			}
      echo json_encode($response);
    } catch (Exception $error) {
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
  }

  private function validateUsuarioRequest() {
		$fields = [
			'nome',
			'sobrenome',
			'email',
			'senha'
		];
		if (!$this->validatePostRequest($fields)) {
      throw new Exception('Erro: campos imcompletos!');
    }
	}
}
