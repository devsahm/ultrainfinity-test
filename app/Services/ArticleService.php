<?php

namespace App\Services;

use App\Models\Article;
use ErrorException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ArticleService
{

    public function allArticles()
    {
        try {
            return Article::orderBy('created_at', 'DESC')->paginate(10);
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

    public function createArticle(array $params)
    {
        try {
           return  Article::create($params);
        } catch (\Throwable $th) {
            throw new ErrorException($th->getMessage());
        }
    }


    
}