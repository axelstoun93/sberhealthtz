<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleRequest;
use App\Http\Resources\Article\ArticleCollection;
use App\Models\Article;
use App\Presenters\Article\ArticlePresenter;
use App\Services\Article\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\Article\ArticleResource;

class ArticleController extends Controller
{


    /**
     * Добавим пагинацию если это статьи,
     * то будет не совсем корректно выкидывать сразу все что есть в базе данных
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try{

            $articles = Article::searchLogic($request)->paginate(25);
            $articles->present(ArticlePresenter::class);

            $articleCollection = new ArticleCollection($articles);

            return $articleCollection->response();

        }catch (\Exception $exception){

            return new JsonResponse(
                [
                    'message' => 'Ошибка при загрузке',
                ], 500);

        }

    }


    /**
     * @param ArticleRequest $request
     * @return JsonResponse|object
     */
    public function store(ArticleRequest $request)
    {
        try{

            $articleService = new ArticleService();
            $articleCreate = $articleService->create($request);

            $presenterArticle = present($articleCreate,ArticlePresenter::class);

            $articleResource = new ArticleResource($presenterArticle);

            return $articleResource->response()->setStatusCode(201);

        }catch (\Exception $exception){

            return new JsonResponse(
                [
                  'message' => 'Ошибка при загрузке',
                ], 500);

        }
    }

}
