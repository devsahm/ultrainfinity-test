<?php

namespace App\Services;

use App\Jobs\IncrementViewedCount;
use App\Models\Article;
use ErrorException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ArticleService
{

    public function allArticles()
    {
        try {
            return Article::orderBy('id', 'DESC')->paginate(10);
        } catch (\Throwable $th) {
            throw new ErrorException($th->getMessage());
        }
    }


    public function showArticleComments(Article $article)
    {
       try {
          return $article->comments;
       } catch (ModelNotFoundException $th) {
        throw new ErrorException($th->getMessage());
       }
    }

    public function getArticle(Article $article)
    {
        IncrementViewedCount::dispatchSync($article)->delay(now()->addSecond(5));
       return $article;
    }

    public function createArticle(array $params)
    {
        try {
           return  Article::create($params);
        } catch (\Throwable $th) {
            throw new ErrorException($th->getMessage());
        }
    }





    
}