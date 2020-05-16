<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $table = 'events';

    public function getFormattedClosingTime(): string
    {
        return date('d.m.yy H:i', $this->closing_time);
    }

    public function isRegistrationOpen(): bool
    {
        return time() < $this->closing_time;
    }

    public function slots(): HasMany
    {
        return $this->hasMany(Slot::class, 'event_id');
    }
}
