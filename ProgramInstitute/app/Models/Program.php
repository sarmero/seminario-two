<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{

    use HasFactory;
    protected $table = 'program';
    public $timestamps = false;

    public function subject():HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function offer():HasMany
    {
        return $this->hasMany(Offer::class);
    }
}
