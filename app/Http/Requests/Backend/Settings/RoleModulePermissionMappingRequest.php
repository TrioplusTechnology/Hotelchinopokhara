<?php

namespace App\Http\Requests\Backend\Settings;

use Illuminate\Foundation\Http\FormRequest;

class RoleModulePermissionMappingRequest extends FormRequest
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
            'role' => ['required', 'integer'],
            'module' => ['required', 'integer'],
            'permission' => ['required', 'array'],
        ];
    }
}
