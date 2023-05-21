<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Composer\Util\Http\Response;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    private $produto;

    public function __construct()
    {
        $this->produto = new Produto();
    }

    public function index()
    {
        $produtosList = $this->produto->all();
        return view('produtos.index',[
            "produtos"=>$produtosList
        ]);
         //return response()->json($produtosList);
    }


    public function show($id)
    {
        //dd($id);
        return view('produtos.show',[
            "produto"=>$this->produto->find($id)
        ]);
    }

    public function store(Request $request)
    {
        $newProduto = $request->all();
        $newProduto['importado'] = $request->has('importado');
        if (!Produto::create($newProduto)) {
            dd("Error ao criar produto!!");
        }
        return redirect('/produtos');
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function edit($id)
    {
        return view('produtos.edit',[
            'produto'=>Produto::find($id)
        ]);
    }

    public function update(Request $request,$id)
    {
        $newProduto = $request->all();
        $newProduto['importado'] = $request->has('importado');
        if (!Produto::find($id)->update($newProduto)) {
            dd("Error ao criar produto!!");
        }
        return redirect('/produtos');
    }

    public function delete($id)
    {
        return view('produtos.delete',[
            'produto'=>Produto::find($id)
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->has('confirmar'))
            if (!Produto::destroy($id))
                dd("Error ao criar produto!!");

        return redirect('/produtos');
    }

}
