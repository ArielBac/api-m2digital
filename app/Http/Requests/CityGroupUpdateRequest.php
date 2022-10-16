<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityGroupUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'city_group' => 'required|unique:city_groups',
        ];
    }

    public function messages() {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'city_group.unique' => 'Este grupo já existe.',
        ];
    }
}
