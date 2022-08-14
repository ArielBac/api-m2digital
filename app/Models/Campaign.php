<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaigns';

    protected $fillable = [
        'city_group_id',
        'campaign',
        'description',
    ];

    public function rules()
    {
        return [
            'city_group_id' => 'required|exists:city_groups,id|unique:campaigns',
            'campaign' => 'required',
            'description' => 'required',
        ];
    }

    public function feedback() {
        return [
            'city_group_id.exists' => 'O grupo selecionado não foi encontrado.',
            'city_group_id.unique' => 'O grupo selecionado já possui uma campanha ativa.',
            'required' => 'O campo :attribute é obrigatório.',
        ];
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_campaigns', 'campaign_id', 'product_id');
    }
}
