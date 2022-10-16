<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityStoreAndUpdateRequest extends FormRequest
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
            'city_group_id' => 'required|exists:city_groups,id',
            'city' => 'required',
            'uf' => 'required',
        ];
    }

    public function messages() {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'city_group_id.exists' => 'O grupo selecionado não foi encontrado.',
        ];
    }

    public function validadeCityAlreadyExists($citiesAlreadyExists, $request) {
        if ($citiesAlreadyExists) {
            foreach ($citiesAlreadyExists as $alreadyExistsCity) {
                if ($alreadyExistsCity['city'] == $request->city && $alreadyExistsCity['uf'] == $request->uf) {
                    return true;
                }
            }
        }
    }
}
