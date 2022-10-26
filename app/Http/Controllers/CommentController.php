<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Article;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function __construct(protected CommentService $commentService)
    {
    }

    public function create(Article $article, CreateCommentRequest $request)
    {
        try {
            $comment = $this->commentService->createComment($article, $request->validated());
            return ResponseHelper::success(CommentResource::make($comment));
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }
}
