<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CommentResource;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function __construct(protected ArticleService $articleService)
    {  
    }

    
    /**
     * @OA\Get(
     *      path="/articles",
     *      operationId="getArticlesList",
     *      tags={"Articles"},
     *      summary="Get list of articles",
     *      description="Returns list of articles",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProjectResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
       try {

        $article = $this->articleService->allArticles();
        return ResponseHelper::success(ArticleResource::collection($article));

       } catch (\Throwable $th) {
        return ResponseHelper::fail($th->getMessage());
       }
    }

    
    public function create(CreateArticleRequest $request)
    {
        try {
            $article = $this->articleService->createArticle($request->validated());
            return ResponseHelper::success(ArticleResource::make($article));
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }


    public function showArticle(Article $article)
    {
        try {
            return ResponseHelper::success(ArticleResource::make($article));
        } catch (ModelNotFoundException $th) {
            return ResponseHelper::fail('resouce nor found');
        }
    }


    public function showComments(Article $article)
    {
        try {
            $comments = $this->articleService->showArticleComments($article);
            return ResponseHelper::success(CommentResource::collection($comments));
            
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }

    public function addLike(Article $article)
    {
        try {
            $article->increment('likes');
            return ResponseHelper::success($article->likes);
        
        } catch (ModelNotFoundException $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }
}
