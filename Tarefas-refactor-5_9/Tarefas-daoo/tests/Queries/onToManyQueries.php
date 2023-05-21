<?php
use \App\Models\{Produto, Fornecedor, Estado, Regiao};


\DB::enableQueryLog(); //Habilita o Log
\DB::getQueryLog(); //Recupera o Log

//Consulta nas regioes que contem no nome su com seus estados
Regiao::where('nome','like','%su%')
    ->with(
        ['estados'
            =>fn($q)=>$q->orderBy('uf','desc')
        ])
    ->get();
//tinker
Regiao::where('nome','like','%su%')->with(['estados'=>fn($q)=>$q->orderBy('uf','desc')])->get();

Fornecedor::whereHas(
            'estado',
            fn($q)=>$q->where('uf','RS'))
        ->with('estado','produtos')
        ->get();
//replica o objeto de estado

Fornecedor::whereHas('estado',fn($q)=>$q->where('uf','RS'))->with('estado','produtos')->get();
//replica o objeto de estado

//Contagem de registros no banco
Produto::whereHas(
        'fornecedor',
        fn($q)=>$q->where('estado_id',21)
        )->count();

//tinker
Produto::whereHas('fornecedor',fn($q)=>$q->where('estado_id',21))->count();


//Recupera produtos importados da regiao Sul com preco de 100 a 2000
Produto::where('importado',1)
				->whereBetween('preco',[100,2000])
				->whereHas(
                    'fornecedor',
					fn($q)=>$q->whereHas(
                        'estado',
                        fn($q)=>$q->whereHas(
                            'regiao',
                            fn($q)=>$q->where('nome','like','Sul')
                        )
                    )
                )
				->get();

Produto::where('importado',1)->whereBetween('preco',[100,2000])->whereHas('fornecedor',fn($q)=>$q->whereHas('estado',fn($q)=>$q->whereHas('regiao',fn($q)=>$q->where('nome','like','Sul'))))->get();
