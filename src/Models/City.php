<?php

namespace Alrez\IranProvinces\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['id', 'state_id', 'name', 'slug'];
    public $timestamps = false;

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}