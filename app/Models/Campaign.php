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

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_campaigns', 'campaign_id', 'product_id');
    }
}
