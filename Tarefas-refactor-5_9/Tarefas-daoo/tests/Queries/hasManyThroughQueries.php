<?php
use \App\Models\{Produto, Fornecedor, Estado, Regiao};

\DB::enableQueryLog(); //Habilita o Log
\DB::getQueryLog(); //Recupera o Log


//Lista de fornecedores da regiao Sul
Fornecedor::whereHas(
    'estado', //passar pela relacao intermediaria
    fn($q)=>$q->whereHas(
        'regiao',
        fn($q)=>$q->where('nome','Sul')
    ))->get();

//Usando relacao hasManyThrough
Regiao::where('nome','Sul')
        ->with('fornecedores')
        ->get();

//Estado RS com produtos
Estado::where('uf','RS')
        ->with('produtos')
        ->get();
