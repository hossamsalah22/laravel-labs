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
            'title' => 'required|min:6',
            'description' => 'required|max:225',
            'user_id' => 'required | exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'A title is required',
            'description.required' => 'A Description is required',
        ];
    }
}