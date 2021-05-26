<?php

namespace Tests\Feature\Article;

use App\Models\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Создаем статью через api
     *
     * @return void
     */
    public function testCreateRequestJson()
    {
        $testArticle = [
          'title' => 'test',
          'text'  => 'test',
          'type'  =>  Article::TYPE_TEXT_DB,
          'author_name' => 'user'
        ];

        $response = $this->postJson('/api/article/save',$testArticle);

        $response->assertStatus(201);

    }
}
