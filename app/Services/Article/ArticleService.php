<?php

namespace App\Services\Article;

use App\Events\Article\ArticleSaveText;
use App\Http\Requests\Article\ArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

class ArticleService {

    /**
     * Метод сохраняет статью
     * @param ArticleRequest $articleRequest
     * @return Article
     */
    public function create(ArticleRequest $articleRequest) :Article {

        $createArticle = new Article();
        $createArticle->title = $articleRequest->title;
        $createArticle->type = $articleRequest->type;
        $createArticle->author_name = $articleRequest->author_name;
        $createArticle->save();

        $createArticleId = $createArticle->id;

        if($articleRequest->type === Article::TYPE_TEXT_DB){
           $this->saveTextDb($createArticleId,$articleRequest->text);
        }

        if($articleRequest->type === Article::TYPE_TEXT_REDIS){
            $this->saveTextRedis($createArticleId,$articleRequest->text);
        }

        if($articleRequest->type === Article::TYPE_TEXT_FILES){
            $this->saveTextFile($createArticleId,$articleRequest->text);

        }

        $createArticle->refresh();

        return $createArticle;
    }

    /**
     * Метод сохраняет текст статьй в базу данных
     * @param int $id
     * @param string $text
     * @return bool
     */
    public function saveTextDb(int $id,string $text) :bool {
        $saveText = Article::find($id)->update(['text' => $text]);
        event(new ArticleSaveText());
        return $saveText;

    }

    /**
     * Метод сохраняет текст статьй в файл
     * @param int $id
     * @param string $text
     * @return bool
     */
    public function saveTextFile(int $id,string $text) :bool {
       $saveText = Storage::disk('local')->put("article/article_$id.txt",$text);
       event(new ArticleSaveText());
       return $saveText;
    }

    /**
     * Метод сохраняет текст статьй в Redis
     * @param int $id
     * @param string $text
     * @return bool
     */
    public function saveTextRedis(int $id,string $text) :bool {
        $redis = Redis::connection();
        $saveText = $redis->set("article:$id",$text);
        event(new ArticleSaveText());
        return $saveText;
    }

    /**
     * Метод возвращает количество статей пользователя
     * добавленых в течении суток
     * @param string $authorName
     * @return int
     */
    public function countDayArticle(string $authorName) :int {
       return Article::whereDate('created_at',Carbon::today())->where('author_name',$authorName)->count();
    }

}
