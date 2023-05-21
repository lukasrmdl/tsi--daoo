<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nome" => $this->faker->text(30),
            "descricao" => fake()->sentence(10),
            "preco" => fake()->randomFloat(2, 100, 10000),
            "qtd_estoque" => fake()->randomNumber(3, false),
            "importado" => fake()->numberBetween(0, 1)
        ];
    }
}
