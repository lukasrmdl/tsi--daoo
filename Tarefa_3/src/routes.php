<?php

use tsi_daoo\Tarefa_3\controller\Route;
use tsi_daoo\Tarefa_3\controller\api\Produto;
use tsi_daoo\Tarefa_3\controller\api\Desconto;
use tsi_daoo\Tarefa_3\controller\api\Usuario;

Route::routes([
	'produto' => Produto::class,
	'desconto' => Desconto::class,
	'usuario' => Usuario::class,
]);

//api:
// composer run api
// ou
// php -S localhost:8081 src/index.php
//
//http://localhost:8081/classe/metodo/parametro
//http://localhost:8081/produto/show/111

// composer run web
// ou
// php -S localhost:8080 -t src/web/ 
//http://localhost:8081/showProduto.php?id=111