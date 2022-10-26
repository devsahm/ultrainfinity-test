<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create articles, for each article attach 2 tags tp it
       $tags  = Tag::factory(10)->create();

       Article::factory(20)->create()->each(function($article) use ($tags){
            $article->tags()->attach($tags->random(2));
       });
    }
}
