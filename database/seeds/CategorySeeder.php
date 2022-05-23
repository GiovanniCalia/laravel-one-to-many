<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Finanza'
            ],
            [
                'name' => 'Estero'
            ],
            [
                'name' => 'Sport'
            ],
            [
                'name' => 'Attualità'
            ],
            [
                'name' => 'Scienze'
            ],
        ];

        foreach ($categories as $category){
            Category::create($category);
        }
    }
}
