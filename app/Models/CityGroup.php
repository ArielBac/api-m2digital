<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityGroup extends Model
{
    protected $table = 'city_groups';

    protected $fillable = [
        'city_group',
    ];

    public function rules()
    {
        return [
            'city_group' => 'required|unique:city_groups',
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'city_group.unique' => 'Este grupo já existe.',
        ];
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'city_group_id', 'id');
    }

    public function campaign()
    {
        return $this->hasOne(Campaign::class, 'city_group_id', 'id');
    }
}
