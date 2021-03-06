<?php

namespace App\Http\Requests\Backend\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomTypeRequest extends FormRequest
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
            'slug' => ['required', 'string', Rule::unique('room_type', 'slug')->ignore($request->id)],
            'status' => ['required', 'boolean'],
            'description' => ['required', 'string'],
            'features' => ['required', 'array'],
            'order' => ['required', 'numeric'],
        ];
    }
}
