<?php

namespace App\CityState\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['id', 'name', 'slug'];
    public $timestamps = false;

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}