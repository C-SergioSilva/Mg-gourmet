<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\Product\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Din Din Gourmet Frango',
                'description' => 'Delicioso din din gourmet de frango com temperos especiais e legumes frescos.',
                'price' => 25.90,
                'user_id' => 1,
            ],
            [
                'name' => 'Din Din Gourmet Carne',
                'description' => 'Din din gourmet de carne bovina com molho especial e acompanhamentos selecionados.',
                'price' => 28.90,
                'user_id' => 1,
            ],
            [
                'name' => 'Din Din Gourmet Peixe',
                'description' => 'Din din gourmet de peixe grelhado com ervas aromáticas e vegetais orgânicos.',
                'price' => 32.90,
                'user_id' => 1,
            ],
            [
                'name' => 'Din Din Vegetariano',
                'description' => 'Din din gourmet vegetariano com quinoa, legumes e molho de ervas finas.',
                'price' => 22.90,
                'user_id' => 1,
            ],
            [
                'name' => 'Din Din Gourmet Premium',
                'description' => 'Nossa opção premium com ingredientes selecionados e apresentação especial.',
                'price' => 39.90,
                'user_id' => 1,
            ],
            [
                'name' => 'Din Din Light',
                'description' => 'Versão light e saudável do nosso din din gourmet, ideal para dietas.',
                'price' => 24.90,
                'user_id' => 2,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
