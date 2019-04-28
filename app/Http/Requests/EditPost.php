<?php

namespace App\Http\Requests;

use App\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditPost extends CreatePost
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
            'title' => 'required|max:100',
            'body' => 'required|max:1400',
        ];
    }
    
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'body' => '本文',
            ];
    }
    
    public function messages()
    {
        return [
            // キーでメッセージが表示されるべきルールを指定する。
            // ドット区切りで左側が項目、右側がルールを意味する。
            ];
    }
}