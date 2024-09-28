<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Tecnologia',
            'Salute',
            'Sport',
            'Arte',
            'Cucina',
            'Elettronica',
            'Abbigliamento',
            'Salute e bellezza',
            'Casa e giardinaggio',
            'Giocattoli',
            'Animali domestici',
            'Libri e riviste',
            'Accessori',
            'Motori',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
