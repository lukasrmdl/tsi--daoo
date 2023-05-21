<?php

use App\Http\Controllers\Api\FornecedorController;
use App\Http\Controllers\Api\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//api/recurso
//api/produto
Route::get('produtos', [ProdutoController::class,'index']);
Route::get('produto/{id}', [ProdutoController::class,'show']);
Route::post('produto', [ProdutoController::class,'store']);
Route::put('produto/{id}', [ProdutoController::class,'update']);
Route::delete('produto/{id}', [ProdutoController::class,'remove']);
// Route::put('produto/{id}',[ProdutoController::class,'update'])//validate;


Route::apiResource('fornecedores', FornecedorController::class)
    ->parameters([
        'fornecedores'=>'fornecedor'
    ]);
Route::get(
    'fornecedores/{fornecedor}/produtos',
    [
        FornecedorController::class,
        'produtos'
    ]
);

Route::get('fornecedores/regiao/{nomeRegiao}',[
    FornecedorController::class,
    'regiao'
]);
