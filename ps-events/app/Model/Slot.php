<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slot extends Model
{
    protected $table = 'slots';

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class, 'slot_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function occupiedPlaces(): int
    {
        return $this->participants->where('activated', true)->count();
    }

    public function sparePlaces(): int
    {
        return $this->capacity - $this->occupiedPlaces();
    }
}
