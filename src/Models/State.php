<?php

namespace Alrez\IranStates\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Alrez\IranStates\Traits\InteractWithStates;

/**
 * Class State
 * @package Alrez\IranStates\Models
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Database\Eloquent\Collection|City[] $cities
 */
class State extends Model
{
    use InteractWithStates;

    protected $fillable = ['id', 'name', 'slug'];
    public $timestamps = false;

    /**
     * Get all cities belonging to this state
     *
     * @return HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
