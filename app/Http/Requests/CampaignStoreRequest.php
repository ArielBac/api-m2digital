<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignStoreRequest extends FormRequest
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
            'city_group_id' => 'required|exists:city_groups,id|unique:campaigns',
            'campaign' => 'required',
            'description' => 'required',
        ];
    }

    public function messages() {
        return [
            'city_group_id.exists' => 'O grupo selecionado não foi encontrado.',
            'city_group_id.unique' => 'O grupo selecionado já possui uma campanha ativa.',
            'required' => 'O campo :attribute é obrigatório.',
        ];
    }
}
