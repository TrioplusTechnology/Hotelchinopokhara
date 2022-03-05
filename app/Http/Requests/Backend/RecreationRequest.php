<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RecreationRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'title' => ['required', 'string'],
            'slug' => ['required', 'string', Rule::unique('recreations', 'slug')->ignore($request->id)],
            'status' => ['required', 'boolean'],
            'description' => ['required', 'string'],
            'image' => 'mimes:jpg,jpeg,png,bmp,tiff|max:4096',
            'order' => ['required', 'numeric'],
        ];
    }
}
