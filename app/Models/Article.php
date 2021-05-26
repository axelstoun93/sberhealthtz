<?php

namespace App\Models;

use Hemp\Presenter\Presentable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    use Presentable;

    /**
     * Текст статьй будет
     * сохранен в базу данных
     */
    public const TYPE_TEXT_DB = 'DB';

    /**
     * Текст статьй будет
     * сохранен в Redis
     */
    public const TYPE_TEXT_REDIS = 'redis';

    /**
     * Текст статьй будет
     * сохранен в файл
     */
    public const TYPE_TEXT_FILES = 'file';

    protected $fillable = [
       'name',
       'text'
    ];

    /**
     * Скоуп поиска по фильтрам
     * в реальном проекте поиск по имени лучше сделать через Full-text search
     * удобнее для пользователей + можно осуществялть поиск по нескольким колонкам в db
     * @param $query
     * @param $request
     * @return mixed
     */
    public function scopeSearchLogic($query,$request){

        if(!empty($request->author_name)){
            $query->where('author_name','like',"%$request->author_name%");
        }

        return $query;
    }
}
