<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    // use HasFactory;
    protected $table = 'offer';
    public $timestamps = false;

    public function admission(): HasMany
    {
        return $this->hasMany(Admission::class);
    }

    public function inscription(): HasMany
    {
        return $this->hasMany(Inscription::class);
    }

    public function stateOffer(): BelongsTo
    {
        return $this->belongsTo(StateOffer::class);
    }

    public function modality(): BelongsTo
    {
        return $this->belongsTo(Modality::class);
    }

    public function calendar(): BelongsTo
    {
        return $this->belongsTo(Calendar::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }


}
