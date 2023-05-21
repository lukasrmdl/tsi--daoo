<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $regiaoSeed = new RegiaoSeeder();
        $regiaoSeed->run();

        (new EstadoSeeder())->run();
        (new PromocaoSeeder())->run();

        Log::channel('stderr')->info('Criando Fornecedores com produtos...');
        Fornecedor::factory(10)
            ->has(
                Produto::factory(25)
                    ->hasMedia(3)
                )
            ->hasMedia(1)
            ->create();

        (new PromocaoProdutoSeeder())->run();
        (new MediaSeeder())->run();
    }
}
