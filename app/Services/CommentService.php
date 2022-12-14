<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Comment;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class CommentService
{

    public function createComment(Article $article, array $params)
    {
        try {
           $comment =  Comment::create([
                'article_id' => $article->id,
                'subject' => $params['subject'],
                'body' => $params['body'],
            ]);

            return $comment;

        } catch (Throwable $th) {
            throw new ErrorException($th->getMessage());
        }
    }
}