<?php

namespace App\Presenters\Article;

use Hemp\Presenter\Presenter;

class ArticlePresenter extends Presenter
{
    public $visible = ['id','title','author_name','created_at'];
}
