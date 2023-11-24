<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OfferSubject extends Model
{
    use HasFactory;
    protected $table = 'offer_subject';
    public $timestamps = false;

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function calendar(): BelongsTo
    {
        return $this->belongsTo(Calendar::class);
    }

    public function inscriptionSubject(): HasMany
    {
        return $this->hasMany(InscriptionSubject::class);
    }

    public function programming(): HasMany
    {
        return $this->hasMany(Programming::class);
    }

    public function activity(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
