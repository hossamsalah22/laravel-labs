<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|unique:posts,title',
            'description' => 'required|min:10|max:225',
            'user_id' => 'required | exists:users,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Post Title is Required',
            'title.unique' => 'Post Title Already exists',
            'title.min' => 'Title must be more than 3 characters',
            'description.required' => 'Post Description is required',
            'description.min' => 'Desctiprion Must be more than 10 character',
            'description.max' => 'Desctiprion cannot exceed 225 character',
            'user_id.required' => 'Please Select User',
            'description.exists' => 'Invalid User ID',
            'image.required' => 'Image is required',
            'image.image' => 'Image is Invalid',
            'image.max' => 'Max Size of image is 2 MB',
        ];
    }
}
