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
            // 'marca_id' => 'exists:marcas,id',
            // 'nome' => 'required|unique:modelos,nome,' . $this->id . '|min:3',
            // 'imagem' => 'required|file|mimes:png,jpeg,jpg',
            // 'numero_portas' => 'required|integer|digits_between:1,5',
            // 'lugares' => 'required|integer|digits_between:1,20',
            // 'air_bag' => 'required|boolean',
            // 'abs' => 'required|boolean' //true, false , 1, 0, "1", "0"
        ];
    }

    public function cityGroups()
    {
        return $this->belongsTo(CityGroup::class, 'city_group_id', 'id');
    }
}
