<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Fornecedor::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $updatedFornecedor = $request->all();
            $storedFornecedor = Fornecedor::create($updatedFornecedor);
            return response()->json([
                'Message'=>"Fornecedor inserido com sucesso",
                'Fornecedor'=>$storedFornecedor
            ]);
        }catch(\Exception $error) {
            $responseError = [
                'Message'=>"Erro ao inserir o Fornecedor!",
                'Exception'=>$error->getMessage()
            ];
            return response()->json($responseError, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Fornecedor $fornecedor)
    {
        return response()->json($fornecedor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        try {
            $updatedFornecedor = $request->all();
            $fornecedor->update($updatedFornecedor);
            return response()->json([
                'Message'=>"Fornecedor atualizado com sucesso",
                'Fornecedor'=>$fornecedor
            ]);
        } catch(\Exception $error) {
            $responseError = [
                'Message'=>"Erro ao atualizar o Fornecedor!",
                'Exception'=>$error->getMessage()
            ];
            return response()->json($responseError, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fornecedor $fornecedor)
    {
        try {
            $fornecedor->delete();//mixed
            return response()->json([
                'Message'=>"Fornecedor id:$fornecedor->id removido!",
            ]);
        } catch(\Exception $error) {
            $responseError = [
                'Message'=>"O fornecedor de id:$fornecedor->id não foi encontrado!",
                'Exception'=>$error->getMessage()
            ];
            return response()->json($responseError, 404);
        }
    }

    public function produtos(Fornecedor $fornecedor)
    {
        return response()->json($fornecedor->load('produtos'));
    }

    public function regiao($nomeRegiao)
    {
        $fornecedores = Fornecedor::whereHas(
            'estado', //passar pela relacao intermediaria
            fn($q)=>$q->whereHas(
                'regiao',
                fn($q)=>$q->where('nome',$nomeRegiao)
            ))->get();
        return response()->json($fornecedores);
    }
}
