<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCampaign extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product_id',
        'campaign_id',
        'discount',
    ];

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'campaign_id' => 'required|exists:campaigns,id',
        ];
    }

    // public function campaign()
    // {
    //     return $this->belongsToMany('App\Models\Campaign');
    // }
}
