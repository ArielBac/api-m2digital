<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityGroup extends Model
{
    protected $table = 'city_groups';

    protected $fillable = [
        'city_group',
    ];

    public function cities()
    {
        return $this->hasMany(City::class, 'city_group_id', 'id');
    }

    public function campaign()
    {
        return $this->hasOne(Campaign::class, 'city_group_id', 'id');
    }
}
