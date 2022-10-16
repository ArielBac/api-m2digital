<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCampaignStoreRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'campaign_id' => 'required|exists:campaigns,id',
        ];
    }

    public function messages() {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'product_id.exists' => 'O produto selecionado não foi encontrado.',
            'campaign_id.exists' => 'A campanha selecionada não foi encontrado.',
        ];
    }
}
