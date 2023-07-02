<?php

namespace Database\Factories;

use App\Models\Situacao;
use App\Models\Tarefa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarefa>
 */
class TarefaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(12,12),
            'tarefa' => fake()->randomElement(['Tarefa 1', 'Tarefa 2', 'Tarefa 3']),
            'data_limite_conclusao' => fake()->date(),
            'situacao_id' => function () {
                return Situacao::inRandomOrder()->first()->id;
            },
            
        ];
    }
    
}
