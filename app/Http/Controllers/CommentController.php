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

     /**
     * @OA\Post(
     *      path="/articles/{id}/comment",
     *      operationId="createComment",
     *      tags={"Comments"},
     *      summary="Store new comments",
     *      description="Create new comments",
     *       @OA\Parameter(
     *          name="id",
     *          description="Article id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *    @OA\RequestBody(
     *    required=true,
     *    description=" comment credentials",
     *    @OA\JsonContent(
     *       required={"body"},
     *       @OA\Property(property="body", type="string", format="body", example="This is my first comment"),
     *       @OA\Property(property="persistent", type="boolean", example="true"),
     *    ),
     * ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
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
