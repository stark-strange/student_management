<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarkStoreRequest extends FormRequest
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
            'student' => 'required|exists:students,id',
            'term' => 'required|exists:term,id',
            'maths_mark' => 'required|numeric|max:100|min:0',
            'science_mark' => 'required|numeric|max:100|min:0',
            'history_mark' => 'required|numeric|max:100|min:0'
        ];
    }
}
