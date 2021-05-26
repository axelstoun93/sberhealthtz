<?php

namespace App\Http\Requests\Article;

use App\Models\Article;
use App\Rules\Article\MaxArticleDay;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|alpha|max:30',
            'text' => 'required',
            'type' => ['required',
                       Rule::in([
                          Article::TYPE_TEXT_DB,
                          Article::TYPE_TEXT_REDIS,
                          Article::TYPE_TEXT_FILES
                       ])
             ],
            'author_name' => ['required',
                              'max:255',
                               new MaxArticleDay()
            ]
        ];
    }
}
