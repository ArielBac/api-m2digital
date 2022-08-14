<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCampaign extends Model
{
    protected $table = 'products_campaigns';

    protected $fillable = [
        'product_id',
        'campaign_id',
        'discount',
        'price_with_discount'
    ];

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'campaign_id' => 'required|exists:campaigns,id',
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'product_id.exists' => 'O produto selecionado não foi encontrado.',
            'campaign_id.exists' => 'A campanha selecionada não foi encontrado.',
        ];
    }
}
