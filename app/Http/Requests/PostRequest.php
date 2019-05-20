<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'=>'required|max:20',
            'body'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'title.max' => "Title can't be greater than 10",
            'body.required'=>'Body is required to post'
        ];
    }
}
