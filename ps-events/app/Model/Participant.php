<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    protected $table = 'participants';

    protected $fillable = [
        'name',
        'group',
        'student_ticket',
        'email',
        'phone',
        'vk_link'
    ];

    public function slot(): BelongsTo
    {
        return $this->belongsTo(Slot::class, 'slot_id');
    }

    public function getActivationSecret(): string
    {
        return md5("hello {$this->id}");
    }

    public function getActivationLink(): string
    {
        return url("activate/{$this->id}/{$this->getActivationSecret()}");
    }
}
