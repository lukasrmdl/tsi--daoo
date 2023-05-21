<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use Composer\Command\ExecCommand;
use Exception;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function index(Request $request)
    {
        $per_page = 10;
        if($request->has('per_page'))
            $per_page = $request->query('per_page');

        return response()->json(Produto::paginate($per_page));
    }

    public function show($id)
    {
        try {
            return response()->json(Produto::findOrFail($id));
        } catch(Exception $error) {
            $responseError = [
                'Message'=>"O produto de id: $id não foi encontrado!",
                'Exception'=>$error->getMessage()
            ];
            return response()->json($responseError, 404);
        }
    }


    public function store(ProdutoRequest $request)
    {
        try {
            $newProduto = $request->all();
            $newProduto['importado'] = $request->has('importado');
            $storedProduto = Produto::create($newProduto);
            return response()->json([
                'Message'=>"Produto inserido com sucesso",
                'Produto'=>$storedProduto
            ]);
        } catch(Exception $error) {
            $responseError = [
                'Message'=>"Erro ao inserir o Produto!",
            ];

            if(env("APP_DEBUG")){
                $responseError['Exception']=$error->getMessage();
                $responseError['Debug']=$error;
            }

            $httpStatus = isset($error->status)?$error->status:500;
            return response()->json($responseError, $httpStatus);
        }
    }

    public function update(ProdutoRequest $request,$id)
    {
        try {
            $newProduto = $request->all();
            $newProduto['importado'] = $request->has('importado');
            $updatedProduto = Produto::findOrFail($id);
            $updatedProduto->update($newProduto);
            return response()->json([
                'Message'=>"Produto atualizado com sucesso",
                'Produto'=>$updatedProduto
            ]);
        } catch(Exception $error) {
            $responseError = [
                'Message'=>"Erro ao inserir o Produto!",
                'Exception'=>$error->getMessage()
            ];
            return response()->json($responseError, 500);
        }
    }

    public function remove($id)
    {
        try {
            // if(!Produto::destroy($id))
            //     throw new Exception("Erro ao remover produto!");
            Produto::findOrFail($id)->delete();//mixed
            return response()->json([
                'Message'=>"Produto id:$id removido!",
            ]);
        } catch(Exception $error) {
            $responseError = [
                'Message'=>"O produto de id: $id não foi encontrado!",
                'Exception'=>$error->getMessage()
            ];
            return response()->json($responseError, 404);
        }
    }
}
