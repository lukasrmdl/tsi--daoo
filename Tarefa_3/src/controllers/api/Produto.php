<?php 

namespace Daoo\Atividade03\controllers\api;

use Daoo\Atividade03\models\Produto as ProdutoModel;
use Exception;

class Produto extends Controller {
  public function __construct() {
    $this->setHeader();
    $this->model = new ProdutoModel();
  }

  public function index() {
    echo json_encode($this->model->read());
  }

  public function show($id) {
    $produto = $this->model->read($id);
    if ($produto) {
      $response = ['produto' => $produto];
    } else {
      $response = ['Erro' => 'Produto não encontrado!'];
      header('HTTP/1.0 404 Not Found');
    }
    echo json_encode($response);
  }

  public function store() {
    try {
      $this->validateProdutoRequest();
      $this->model = new ProdutoModel(
				$_POST['modelo'],
				$_POST['marca'],
				$_POST['categoria'],
				$_POST['informacoes'],
        $_POST['preco']
			);
      if ($this->model->create()) {
        echo json_encode([
          "success" => "Produto criado com sucesso!",
					"data" => $this->model->getColumns()
        ]);
      } else {
        throw new Exception("Erro ao criar produto!");
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
        throw new Exception("Informe o ID do Produto!!");
      }
      $this->validateProdutoRequest();
      $this->model = new ProdutoModel(
				$_POST['modelo'],
				$_POST['marca'],
				$_POST['categoria'],
				$_POST['informacoes'],
        $_POST['preco']
			);
      $this->model->id = $_POST["id"];
      if ($this->model->update()) {
        echo json_encode([
          "success" => "Produto atualizado com sucesso!",
					"data" => $this->model->getColumns()
        ]);
      } else {
        throw new Exception("Erro ao atualizar produto!");
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
				$response = ["message:" => "Produto id:$id removido com sucesso!"];
			} else {
				$this->setHeader(500,'Internal Error.');
				throw new Exception("Erro ao remover Produto!");
			}
      echo json_encode($response);
    } catch (Exception $error) {
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
  }

  private function validateProdutoRequest() {
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