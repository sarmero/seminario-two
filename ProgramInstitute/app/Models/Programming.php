<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Programming extends Model
{
    use HasFactory;
    protected $table = 'programming';
    public $timestamps = false;

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function offerSubject(): BelongsTo
    {
        return $this->belongsTo(OfferSubject::class);
    }
}
