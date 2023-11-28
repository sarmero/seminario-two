<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inscription extends Model
{
    use HasFactory;
    protected $table = 'inscription';
    public $timestamps = false;

    protected $fillable = [
		'student_id',
		'offer_id'
	];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    public function inscriptionSubject(): HasMany
    {
        return $this->hasMany(InscriptionSubject::class);
    }
}
