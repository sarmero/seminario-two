<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InscriptionSubject extends Model
{
    use HasFactory;
    protected $table = 'inscription_subject';
    public $timestamps = false;

    public function inscription(): BelongsTo
    {
        return $this->belongsTo(Inscription::class);
    }

    public function offerSubject(): BelongsTo
    {
        return $this->belongsTo(OfferSubject::class);
    }
}
