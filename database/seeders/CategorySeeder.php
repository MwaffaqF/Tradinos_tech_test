<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Done',
            'color' => 'Green',
        ]);

        Category::create([
            'name' => 'Todo',
            'color' => 'Yellow',
        ]);

        Category::create([
            'name' => 'Processing',
            'color' => 'Blue',
        ]);

        Category::create([
            'name' => 'Urgent',
            'color' => 'Red',
        ]);
    }
}
