<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Calendar extends Model
{
    use HasFactory;
    protected $table = 'calendar';
    public $timestamps = false;

    public function offer(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function offerSubject(): HasMany
    {
        return $this->hasMany(OfferSubject::class);
    }
}
