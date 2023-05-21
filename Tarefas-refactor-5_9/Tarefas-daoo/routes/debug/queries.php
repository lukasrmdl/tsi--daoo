<?php

use App\Models\{Regiao, Estado, Fornecedor, Produto, Promocao};
use Illuminate\Support\Facades\Route;
use Barryvdh\Debugbar\Facades\Debugbar;

Route::prefix('queries')->group(function () {

    Route::get('fornecedor-regiao',function(){
        dump(
            Fornecedor::whereHas(
                'estado', //passar pela relacao intermediaria
                fn($q)=>$q->whereHas(
                    'regiao',
                    fn($q)=>$q->where('nome','Norte')
                ))->get()
        );
    });

    Route::get('produtos/', function () {
        dump(
            Produto::whereBetween('preco', [100,500])
                ->where('importado', true)
                ->get(['nome','preco','id','fornecedor_id'])->toArray()
        );
    });

    Route::get('produtos-fornecedor/', function () {
        dump(
            Produto::with('fornecedor')
                ->get(['nome','preco','id','fornecedor_id'])
                ->toArray()
        );
    });

    //N+1
    Route::get('fornecedores-estados/',function(){
        $listEstados = collect([]);
        Fornecedor::all()->each(function ($f) use ($listEstados){
            $listEstados->push($f->estado->uf);
        });
        Debugbar::error($listEstados);
        dump($listEstados);
    });

    Route::get('fornecedores-estados-load/',function(){
        $listEstados = collect([]);
        Fornecedor::all()->load('estado')->each(function ($f) use ($listEstados){
            $listEstados->push($f->estado->uf);
        });
        Debugbar::error($listEstados);
        dump($listEstados);
    });
});
