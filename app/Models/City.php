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

    public function rules()
    {
        return [
            'city_group_id' => 'required|exists:city_groups,id',
            'city' => 'required',
            'uf' => 'required',
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'city_group_id.exists' => 'O grupo selecionado não foi encontrado.',
        ];
    }

    public function validadeCityAlreadyExists($citiesAlreadyExists, $request) {
        if ($citiesAlreadyExists) {
            foreach ($citiesAlreadyExists as $alreadyExistsCity) {
                if ($alreadyExistsCity['city'] == $request->city && $alreadyExistsCity['uf'] == $request->uf) {
                    return true;
                }
            }
        }
    }

    public function cityGroups()
    {
        return $this->belongsTo(CityGroup::class, 'city_group_id', 'id');
    }
}
