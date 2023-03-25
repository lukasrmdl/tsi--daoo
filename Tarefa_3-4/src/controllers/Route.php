<?php 
namespace Daoo\Atividade03\controllers;

use Daoo\Atividade03\controllers\api\Controller;

class Route {
	public static $query;

	public static function routes(Array $routes) {
		$url_path = trim($_SERVER['REQUEST_URI'], '/');
		self::$query = explode('/', $url_path);
		
		$class = null;
		$method = null;
		$param = null;

		error_log("Route: $url_path"); 
		error_log("Query array: \n".print_r(self::$query, TRUE));
		if (self::$query) {
			$class_name = self::$query[0];
			if (count(self::$query) > 1) {
				$method = self::$query[1];
				$param = (count(self::$query) > 2) ? self::$query[2] : null;
			}

			if (isset($routes[$class_name])) {
				$class = new $routes[$class_name];
				if ($class instanceof Controller) {
					if ($method && method_exists($class, $method)) {
						if ($param) {
							$class->$method($param);
						} else {
							$class->$method();
						}
					} else {
						if (method_exists($class, 'index')) {
              $class->index();
            } else {
              $class = null;
            } 
					}
				}
			}
		}

		if (!$class) {
      header('HTTP/1.0 404 Not Found');
    }
	}
}
