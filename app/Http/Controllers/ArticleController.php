<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CommentResource;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    
     /**
     * @OA\Post(
     *      path="/articles",
     *      operationId="createArticle",
     *      tags={"Articles"},
     *      summary="Store new Article",
     *      description="Create new article",
     *    @OA\RequestBody(
     *    required=true,
     *    description=" comment credentials",
     *    @OA\JsonContent(
     *       required={"body", "subject", "image"},
     *       @OA\Property(property="body", type="string", format="body", example="This is my first comment"),
     *       @OA\Property(property="subject", type="string", format="subject", example="Happy codding"),
     *      @OA\Property(property="image", type="string", format="image", example="https://via.placeholder.com/300/09f/fff.png"),
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
    public function create(CreateArticleRequest $request)
    {
        try {
            $article = $this->articleService->createArticle($request->validated());
            return ResponseHelper::success(ArticleResource::make($article));
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }


     /**
     * @OA\Get(
     *      path="/articles/{id}",
     *      operationId="showArticles",
     *      tags={"Articles"},
     *      summary="Get articles information",
     *      description="Returns list of articles",
     *      @OA\Parameter(
     *          name="id",
     *          description="Article id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
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
    public function showArticle(Article $article)
    {
        
        try {
           $article = $this->articleService->getArticle($article);
           return ResponseHelper::success(ArticleResource::make($article));
        } catch (ModelNotFoundException $th) {
            return ResponseHelper::fail('resouce nor found');
        }
    }


      /**
     * @OA\Get(
     *      path="/articles/{id}/comment",
     *      operationId="getArticlesCommentList",
     *      tags={"Articles"},
     *      summary="Get lists of comments for an article",
     *      description="Returns list of comments",
     *      @OA\Parameter(
     *          name="id",
     *          description="Article id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
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
    public function showComments(Article $article)
    {
        try {
            $comments = $this->articleService->showArticleComments($article);
            return ResponseHelper::success(CommentResource::collection($comments));
            
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }



        /**
     * @OA\Post(
     *      path="/articles/{id}/like",
     *      operationId="Add Likes to Article",
     *      tags={"Articles"},
     *      summary="Like Article",
     *      description=" Add new Likes to Article",
     *       @OA\Parameter(
     *          name="id",
     *          description="Article id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
    public function addLike(Article $article)
    {
        try {
            $article->increment('likes');
            return ResponseHelper::success($article->likes);
        
        } catch (ModelNotFoundException $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }

  /**
     * @OA\Get(
     *      path="/articles/{id}/view",
     *      operationId="getArticlesViews",
     *      tags={"Articles"},
     *      summary="Get An article viewa",
     *      description="Returns list of comments",
     *      @OA\Parameter(
     *          name="id",
     *          description="Article id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
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
    public function viewsofArticle(Article $article)
    {
        try {
            return ResponseHelper::success($article->views);
        } catch (ModelNotFoundException $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }

}
