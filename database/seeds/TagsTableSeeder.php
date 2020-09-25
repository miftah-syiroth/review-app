<?php

use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['Framework', 'Frontend', 'Backend', 'Designing', 'Coding']);
        $tags->each(function ($c) {
            Tag::create([
                'name' => $c,
                'slug' => Str::slug($c),
            ]);
        });
    }
}
