<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\Promocao;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Seeder;

class PromocaoProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listProdutos = Produto::all();
        $totalPromocao = Promocao::count();

        if(!$totalPromocao || !$listProdutos->count()) {
            throw new Exception('Error: registrar produtos e/ou promocoes!');
        }

        $now = Carbon::now()->toDateTimeString();
        $content = [
            'created_at'=>$now,
            'updated_at'=>$now
        ];

        Log::channel('stderr')->info('Relacionando promocoes e produtos...');

        $listProdutos->each(
            function ($produto)
                use ($totalPromocao, $content) {
            $promoId = rand(1, $totalPromocao);
            $promoId2 = ($promoId+1>$totalPromocao) ? $promoId-1 : $promoId+1;
            $content['desconto'] = fake()->randomFloat(1,1,100);
            $produto->promocoes()->attach([
                $promoId=>$content,
                $promoId2=>$content,
            ]);
            Log::channel('stderr')
                ->info("Produto: $produto->id | Promocoes: ( $promoId , $promoId2 )");
        });
    }
}
