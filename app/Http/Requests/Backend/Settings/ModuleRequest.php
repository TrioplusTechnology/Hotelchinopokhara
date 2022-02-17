<?php

namespace App\Http\Requests\Backend\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ModuleRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'code' => ['required', 'string', Rule::unique('modules', 'code')->ignore($request->id)],
            'status' => ['required', 'boolean'],
            'description' => ['required', 'string'],
        ];
    }
}
