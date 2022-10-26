<?php

namespace App\Http\Requests;

use App\Traits\ValidationResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{
    use ValidationResponseTrait;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'body' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'article_id.required' => 'the article is required',
            'article.exists' => 'The article selected does not exist, hence invalid',
        ];
    }
}
