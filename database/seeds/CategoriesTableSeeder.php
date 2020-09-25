<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect(['Laravel', 'Bootstrap', 'PHP', 'Wordpress']);
        $categories->each(function ($c) {
            Category::create([
                'name' => $c,
                'slug' => Str::slug($c),
            ]);
        });
    }
}