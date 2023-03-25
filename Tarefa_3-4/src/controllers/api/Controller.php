<?php 

namespace Daoo\Atividade03\controllers\api;

use Exception;
abstract class Controller {
	protected $model;
	public abstract function index();

	protected function setHeader(int $statusCode = 0, string $message = '') {
		if(!$statusCode) {
      header("Content-Type:application/json;charset=utf-8'");
    } else {
      header("HTTP/1.0 $statusCode $message");
    }
	}

	protected function validatePostRequest(array $fields):bool {
		foreach($fields as $field) {
      if (!isset($_POST[$field])) {
				$this->setHeader(400,'Bad Request');
				return false;
			}
    }
		return true;
	}

	public function filter() {
		$response = $this->model->filter($_POST);
		if (!$response) {
			echo json_encode('Sem resposta para: ' . $response);
		} else {
			echo json_encode('Retorno: ' . $response);
		}
	}
}
