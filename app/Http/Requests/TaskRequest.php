<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Rules\CheckParentUser;
use App\Http\Rules\CheckNestedTaskDepth;

class TaskRequest extends FormRequest
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
     * Get the validation messages that apply to the erroneous request.
     *
     * @return bool
     */
    public function messages()
    {
        return [           
            'points.digits_between' => 'Enter 1 to 10 digits',
            'user_id.required' => 'The user select is required'
        ];
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
            'points' => 'required|integer|between:1,10',
            'user_id' => ['required', new CheckParentUser],
            'parent_id' => ['nullable', new CheckNestedTaskDepth]
        ];
    }
}
