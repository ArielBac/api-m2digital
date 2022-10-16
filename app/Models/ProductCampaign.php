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
}
