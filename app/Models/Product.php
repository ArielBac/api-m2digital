<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product',
        'description',
        'price',
    ];

    public function rules()
    {
        return [
            // 'marca_id' => 'exists:marcas,id',
            // 'nome' => 'required|unique:modelos,nome,' . $this->id . '|min:3',
            // 'imagem' => 'required|file|mimes:png,jpeg,jpg',
            // 'numero_portas' => 'required|integer|digits_between:1,5',
            // 'lugares' => 'required|integer|digits_between:1,20',
            // 'air_bag' => 'required|boolean',
            // 'abs' => 'required|boolean' //true, false , 1, 0, "1", "0"
        ];
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'products_campaigns', 'product_id', 'campaign_id');
    }
}
