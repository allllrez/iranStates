<?php

namespace Alrez\IranStates\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Alrez\IranStates\Traits\InteractWithState;

/**
 * Class City
 * @package Alrez\IranStates\Models
 *
 * @property int $id
 * @property int $state_id
 * @property string $name
 * @property string $slug
 * @property State $state
 */
class City extends Model
{
    use InteractWithState;

    protected $fillable = ['id', 'state_id', 'name', 'slug'];
    public $timestamps = false;

    /**
     * Get the state that this city belongs to
     *
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
