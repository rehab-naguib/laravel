<?php

namespace App\Http\Requests;

use App\Rules\numberOfPosts;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            "title" => "required|min:5|unique:posts",
            "discription" => "required",
            "user" => "required",
            'numberOfPosts' => ['required', new numberOfPosts]
        ];
    }
}
