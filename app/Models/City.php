<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'city_group_id',
        'city',
        'uf',
    ];

    public function cityGroup()
    {
        return $this->belongsTo(CityGroup::class, 'city_group_id', 'id');
    }
}
