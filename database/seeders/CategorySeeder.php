<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Web Development'],
            ['name' => 'Mobile Development'],
            ['name' => 'AI & ML'],
            ['name' => 'Cybersecurity'],
            ['name' => 'Cloud Computing'],
            ['name' => 'DevOps'],
            ['name' => 'Game Development'],
            ['name' => 'UI/UX Design'],
            ['name' => 'Tech News'],
            ['name' => 'Data Science'],
        ];

        foreach($categories as $category){
            Category::create($category);
        }

    }
}
