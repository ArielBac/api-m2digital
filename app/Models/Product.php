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

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'products_campaigns', 'product_id', 'campaign_id');
    }
}
