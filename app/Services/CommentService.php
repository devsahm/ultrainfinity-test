<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Comment;
use ErrorException;

class CommentService
{

    public function createComment(Article $article, array $params)
    {
        try {

           $comment =  Comment::create([
                'article_id' => $article->id,
                'body' => $params['body'],
            ]);
            return $comment;

        } catch (\Throwable $th) {
            throw new ErrorException('Comment cannot be created');
        }
    }
}