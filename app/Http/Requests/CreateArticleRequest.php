<?php

namespace App\Http\Requests;

use App\Traits\ValidationResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
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
            'subject' => 'required|min:2',
            'body'=> 'required|min:10',
            'image' => 'required',
        ];
    }
}
